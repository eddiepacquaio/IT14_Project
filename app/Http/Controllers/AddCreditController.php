<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AddCreditController extends Controller
{
    private function userId()
    {
        return Auth::id() ?? session('user_id');
    }

    private function getBalance($debtorId, $userId)
    {
        $credits = DB::table('transactions')
            ->where('user_id', $userId)
            ->where('debtor_id', $debtorId)
            ->where('type', 'credit')
            ->sum('amount');

        $payments = DB::table('transactions')
            ->where('user_id', $userId)
            ->where('debtor_id', $debtorId)
            ->where('type', 'payment')
            ->sum('amount');

        return max(0, (float) $credits - (float) $payments);
    }

    public function create(Request $request, $debtor)
    {
        $userId = $this->userId();

        if (!$userId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $debtorRecord = DB::table('debtors')
            ->where('id', $debtor)
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->first();

        if (!$debtorRecord) {
            return redirect()->route('debtors.index')
                ->with('error', 'Debtor not found.');
        }

        $query = trim($request->query('search', ''));

        $products = DB::table('products')
            ->where('user_id', $userId)
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->get();

        $currentBalance = $this->getBalance($debtor, $userId);

        return view('debtors.add-credit', compact(
            'debtorRecord',
            'products',
            'currentBalance',
            'query'
        ));
    }

    public function store(Request $request, $debtor)
    {
        $userId = $this->userId();

        if (!$userId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $debtorRecord = DB::table('debtors')
            ->where('id', $debtor)
            ->where('user_id', $userId)
            ->whereNull('deleted_at')
            ->first();

        if (!$debtorRecord) {
            return redirect()->route('debtors.index')
                ->with('error', 'Debtor not found.');
        }

        $validated = $request->validate([
            'amount' => ['nullable', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:1000'],
            'items' => ['nullable', 'array'],
            'items.*.product_id' => ['required', 'integer'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.sale_mode' => ['required', 'in:package,item'],
        ]);

        $items = $validated['items'] ?? [];
        $description = trim($validated['description'] ?? '');

        if (count($items) === 0 && empty($validated['amount'])) {
            throw ValidationException::withMessages([
                'amount' => 'Select products or enter an amount greater than zero.',
            ]);
        }

        try {
            DB::transaction(function () use (
                $items,
                $validated,
                $description,
                $debtor,
                $userId,
                $debtorRecord
            ) {
                $currentBalance = $this->getBalance($debtor, $userId);
                $creditLimit = (float) ($debtorRecord->credit_limit ?? 0);

                $saleItems = [];
                $totalAmount = 0;

                foreach ($items as $cartItem) {
                    $product = DB::table('products')
                        ->where('id', $cartItem['product_id'])
                        ->where('user_id', $userId)
                        ->lockForUpdate()
                        ->first();

                    if (!$product) {
                        throw ValidationException::withMessages([
                            'items' => 'One of the selected products could not be found.',
                        ]);
                    }

                    $quantity = (int) $cartItem['quantity'];
                    $saleMode = $cartItem['sale_mode'];

                    $canSellByItem = (float) ($product->item_price ?? 0) > 0
                        && (float) ($product->measurement_value ?? 0) > 0;

                    if ($saleMode === 'item' && !$canSellByItem) {
                        throw ValidationException::withMessages([
                            'items' => $product->name . ' cannot be sold as a single item.',
                        ]);
                    }

                    $unitPrice = $saleMode === 'item'
                        ? (float) $product->item_price
                        : (float) $product->unit_price;

                    // A package consumes its measurement_value in stock.
                    $stockPerSale = $saleMode === 'item'
                        ? 1
                        : max(1, (int) ($product->measurement_value ?? 1));

                    $stockToDeduct = $quantity * $stockPerSale;

                    if ((float) $product->stock_quantity < $stockToDeduct) {
                        throw ValidationException::withMessages([
                            'items' => $product->name . ' does not have enough stock.',
                        ]);
                    }

                    $lineTotal = $quantity * $unitPrice;
                    $totalAmount += $lineTotal;

                    $saleItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'stock_to_deduct' => $stockToDeduct,
                    ];

                    DB::table('products')
                        ->where('id', $product->id)
                        ->where('user_id', $userId)
                        ->decrement('stock_quantity', $stockToDeduct);
                }

                if (count($items) === 0) {
                    $totalAmount = (float) $validated['amount'];
                }

                if ($totalAmount <= 0) {
                    throw ValidationException::withMessages([
                        'amount' => 'The credit amount must be greater than zero.',
                    ]);
                }

                if ($creditLimit > 0 && ($currentBalance + $totalAmount) > $creditLimit) {
                    $remaining = max(0, $creditLimit - $currentBalance);

                    throw ValidationException::withMessages([
                        'credit_limit' => 'This credit exceeds the debtor\'s limit. Remaining credit: ₱'
                            . number_format($remaining, 2),
                    ]);
                }

                if (count($items) > 0) {
                    $saleId = DB::table('sales')->insertGetId([
                        'user_id' => $userId,
                        'debtor_id' => $debtor,
                        'sale_type' => 'credit',
                        'total_amount' => $totalAmount,
                        'customer_name' => $debtorRecord->full_name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    foreach ($saleItems as $saleItem) {
                        DB::table('sale_items')->insert([
                            'sale_id' => $saleId,
                            'product_id' => $saleItem['product']->id,
                            'product_name' => $saleItem['product']->name,
                            'unit_price' => $saleItem['unit_price'],
                            'quantity' => $saleItem['quantity'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    DB::table('transactions')->insert([
                        'user_id' => $userId,
                        'debtor_id' => $debtor,
                        'type' => 'credit',
                        'amount' => $totalAmount,
                        'description' => $description !== ''
                            ? $description
                            : 'Credit sale #' . $saleId,
                        'product_id' => null,
                        'quantity' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('transactions')->insert([
                        'user_id' => $userId,
                        'debtor_id' => $debtor,
                        'type' => 'credit',
                        'amount' => $totalAmount,
                        'description' => $description !== ''
                            ? $description
                            : 'Manual credit entry',
                        'product_id' => null,
                        'quantity' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });

            return redirect()->route('debtors.show', $debtor)
                ->with('success', 'Credit sale successfully added.');

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Unable to save the credit sale. Please check your stock and database columns.');
        }
    }
}

