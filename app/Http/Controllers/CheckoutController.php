<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Throwable;

class CheckoutController extends Controller
{
    private function getUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    public function index()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $cart = session('sell_cart', []);

        if (empty($cart)) {
            return redirect()->route('sell.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $price = (float) ($item['price'] ?? 0);
            $quantity = (float) ($item['quantity'] ?? 0);

            $total += $price * $quantity;
        }

        $debtorsQuery = DB::table('debtors')
            ->where('user_id', $userId);

        if (Schema::hasColumn('debtors', 'deleted_at')) {
            $debtorsQuery->whereNull('deleted_at');
        }

        $debtors = $debtorsQuery
            ->orderBy('full_name')
            ->get();

        return view('sell.checkout', compact(
            'cart',
            'total',
            'debtors'
        ));
    }

    public function complete(Request $request)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        /*
        |--------------------------------------------------------------------------
        | Validate payment information
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'payment_type' => 'required|in:cash,credit',
            'debtor_id' => 'nullable|required_if:payment_type,credit|integer',
        ], [
            'payment_type.required' => 'Please select a payment method.',
            'payment_type.in' => 'Invalid payment method selected.',
            'debtor_id.required_if' => 'Please select a debtor for an Utang transaction.',
        ]);

        $paymentType = $validated['payment_type'];
        $debtorId = $validated['debtor_id'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Validate cart
        |--------------------------------------------------------------------------
        */

        $cart = session('sell_cart', []);

        if (empty($cart)) {
            return redirect()->route('sell.index')
                ->with('error', 'Your shopping cart is empty.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validate debtor ownership
        |--------------------------------------------------------------------------
        */

        if ($paymentType === 'credit') {

            $debtorQuery = DB::table('debtors')
                ->where('id', $debtorId)
                ->where('user_id', $userId);

            if (Schema::hasColumn('debtors', 'deleted_at')) {
                $debtorQuery->whereNull('deleted_at');
            }

            $debtor = $debtorQuery->first();

            if (!$debtor) {
                throw ValidationException::withMessages([
                    'debtor_id' => 'The selected debtor does not exist.',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Validate cart items and calculate total on the server
        |--------------------------------------------------------------------------
        */

        $total = 0;
        $cleanCart = [];

        foreach ($cart as $productId => $item) {

            $id = (int) ($item['product_id'] ?? $productId);
            $quantity = (float) ($item['quantity'] ?? 0);

            if ($id <= 0 || $quantity <= 0) {
                throw ValidationException::withMessages([
                    'cart' => 'Your cart contains an invalid product or quantity.',
                ]);
            }

            $product = DB::table('products')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->first();

            if (!$product) {
                throw ValidationException::withMessages([
                    'cart' => 'A product in your cart could not be found.',
                ]);
            }

            $price = (float) ($item['price'] ?? 0);

            if ($price < 0) {
                throw ValidationException::withMessages([
                    'cart' => 'A product has an invalid price.',
                ]);
            }

            $cleanCart[] = [
                'product_id' => $id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'unit' => $item['unit'] ?? 'pcs',
            ];

            $total += $price * $quantity;
        }

        if (empty($cleanCart)) {
            throw ValidationException::withMessages([
                'cart' => 'Your shopping cart is empty.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Save sale and sale items
        |--------------------------------------------------------------------------
        */

        try {

            $saleId = DB::transaction(function () use (
                $userId,
                $paymentType,
                $debtorId,
                $cleanCart,
                $total
            ) {

                $now = now();

                /*
                |--------------------------------------------------------------------------
                | Lock and verify product stock
                |--------------------------------------------------------------------------
                */

                foreach ($cleanCart as $item) {

                    $product = DB::table('products')
                        ->where('id', $item['product_id'])
                        ->where('user_id', $userId)
                        ->lockForUpdate()
                        ->first();

                    if (!$product) {
                        throw ValidationException::withMessages([
                            'cart' => 'A product in your cart no longer exists.',
                        ]);
                    }

                    if ((float) $product->stock_quantity < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'cart' => 'Insufficient stock for ' . $product->name . '.',
                        ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Create sales record
                |--------------------------------------------------------------------------
                */

                $saleData = [
                    'user_id' => $userId,
                    'debtor_id' => $paymentType === 'credit' ? $debtorId : null,
                    'sale_type' => $paymentType,
                    'total_amount' => $total,
                ];

                if (Schema::hasColumn('sales', 'customer_name')) {
                    $saleData['customer_name'] = null;
                }

                if (Schema::hasColumn('sales', 'payment_method')) {
                    $saleData['payment_method'] = $paymentType;
                }

                if (Schema::hasColumn('sales', 'payment_provider')) {
                    $saleData['payment_provider'] = null;
                }

                if (Schema::hasColumn('sales', 'payment_reference')) {
                    $saleData['payment_reference'] = null;
                }

                if (Schema::hasColumn('sales', 'created_at')) {
                    $saleData['created_at'] = $now;
                }

                if (Schema::hasColumn('sales', 'updated_at')) {
                    $saleData['updated_at'] = $now;
                }

                $saleId = DB::table('sales')->insertGetId($saleData);

                /*
                |--------------------------------------------------------------------------
                | Create sale items and deduct inventory
                |--------------------------------------------------------------------------
                */

                foreach ($cleanCart as $item) {

                    $saleItemData = [
                        'sale_id' => $saleId,
                        'product_id' => $item['product_id'],
                        'product_name' => $item['product_name'],
                        'unit_price' => $item['price'],
                        'quantity' => $item['quantity'],
                    ];

                    if (Schema::hasColumn('sale_items', 'created_at')) {
                        $saleItemData['created_at'] = $now;
                    }

                    if (Schema::hasColumn('sale_items', 'updated_at')) {
                        $saleItemData['updated_at'] = $now;
                    }

                    DB::table('sale_items')->insert($saleItemData);

                    DB::table('products')
                        ->where('id', $item['product_id'])
                        ->where('user_id', $userId)
                        ->decrement('stock_quantity', $item['quantity']);
                }

                /*
                |--------------------------------------------------------------------------
                | Create debtor credit transaction
                |--------------------------------------------------------------------------
                */

                if ($paymentType === 'credit') {

                    $transactionData = [
                        'user_id' => $userId,
                        'debtor_id' => $debtorId,
                        'type' => 'credit',
                        'amount' => $total,
                        'description' => 'Product purchase - Sale #' . $saleId,
                    ];

                    $optionalTransactionFields = [
                        'product_id' => null,
                        'quantity' => null,
                        'payment_method' => null,
                        'payment_provider' => null,
                        'payment_reference' => null,
                    ];

                    foreach ($optionalTransactionFields as $column => $value) {
                        if (Schema::hasColumn('transactions', $column)) {
                            $transactionData[$column] = $value;
                        }
                    }

                    if (Schema::hasColumn('transactions', 'created_at')) {
                        $transactionData['created_at'] = $now;
                    }

                    if (Schema::hasColumn('transactions', 'updated_at')) {
                        $transactionData['updated_at'] = $now;
                    }

                    DB::table('transactions')->insert($transactionData);
                }

                return $saleId;
            });

            /*
            |--------------------------------------------------------------------------
            | Clear cart after successful transaction
            |--------------------------------------------------------------------------
            */

            session()->forget('sell_cart');

            return redirect()->route('sell.index')
                ->with('success', 'Transaction completed successfully! Sale #' . $saleId);

        } catch (ValidationException $e) {
            throw $e;

        } catch (Throwable $e) {

            report($e);

            return redirect()->route('sell.checkout')
                ->withInput()
                ->with('error', 'Unable to complete the transaction. Please check your database structure and try again.');
        }
    }

    public function receipt($id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $sale = DB::table('sales')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$sale) {
            return redirect()->route('sell.index')
                ->with('error', 'Sale receipt not found.');
        }

        $items = DB::table('sale_items')
            ->where('sale_id', $id)
            ->get();

        return view('sell.receipt', compact('sale', 'items'));
    }
}
