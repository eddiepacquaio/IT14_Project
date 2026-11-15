<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Get the currently logged-in user's ID.
     */
    private function currentUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    /**
     * DISPLAY INVENTORY
     */
    public function index(Request $request)
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $search = trim((string) $request->query('search', ''));

        $query = DB::table('products')
            ->where('user_id', $userId);

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $products = $query
            ->orderBy('name', 'asc')
            ->get();

        return view('inventory.index', compact('products', 'search'));
    }

    /**
     * SHOW ADD PRODUCT FORM
     */
    public function create()
    {
        if (!$this->currentUserId()) {
            return redirect('/login');
        }

        return view('inventory.create');
    }

    /**
     * SAVE NEW PRODUCT
     */
    public function store(Request $request)
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:50'],
            'measurement_value' => ['nullable', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'package_price' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['nullable', 'numeric', 'min:0'],
            'low_stock_threshold' => ['nullable', 'numeric', 'min:0'],
        ], [
            'name.required' => 'Please enter the product name.',
            'selling_price.required' => 'Please enter the selling price.',
            'selling_price.numeric' => 'Please enter a valid selling price.',
            'unit.required' => 'Please select a product unit.',
        ]);

        $stock = (float) ($validated['stock_quantity'] ?? 0);

        if ($validated['unit'] === 'piece' && floor($stock) != $stock) {
            return back()
                ->withErrors([
                    'stock_quantity' =>
                        'Products measured by piece must have a whole-number stock quantity.',
                ])
                ->withInput();
        }

        $sellingPrice = (float) $validated['selling_price'];
        $packagePrice = $validated['package_price'] ?? null;

        $unitPrice = ($packagePrice === null || $packagePrice === '')
            ? $sellingPrice
            : (float) $packagePrice;

        DB::table('products')->insert([
            'user_id' => $userId,
            'name' => trim($validated['name']),
            'category' => filled($validated['category'] ?? null)
                ? trim($validated['category'])
                : null,
            'unit' => $validated['unit'],
            'measurement_value' =>
                ($validated['measurement_value'] ?? '') === ''
                    ? null
                    : (float) $validated['measurement_value'],
            'unit_price' => $unitPrice,
            'item_price' => $sellingPrice,
            'stock_quantity' => $stock,
            'low_stock_threshold' =>
                (float) ($validated['low_stock_threshold'] ?? 5),
        ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product added to your inventory successfully!');
    }

    /**
     * SHOW EDIT PRODUCT FORM
     */
    public function edit($id)
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            return redirect()
                ->route('inventory.index')
                ->with('error', 'Product not found.');
        }

        return view('inventory.edit', compact('product'));
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(Request $request, $id)
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            return redirect()
                ->route('inventory.index')
                ->with('error', 'Product not found.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:50'],
            'measurement_value' => ['nullable', 'numeric', 'min:0'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'numeric', 'min:0'],
            'low_stock_threshold' => ['nullable', 'numeric', 'min:0'],
        ]);

        $stock = (float) $validated['stock_quantity'];

        if ($validated['unit'] === 'piece' && floor($stock) != $stock) {
            return back()
                ->withErrors([
                    'stock_quantity' =>
                        'Products measured by piece must have a whole-number stock quantity.',
                ])
                ->withInput();
        }

        DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'name' => trim($validated['name']),
                'category' => filled($validated['category'] ?? null)
                    ? trim($validated['category'])
                    : null,
                'unit' => $validated['unit'],
                'measurement_value' =>
                    ($validated['measurement_value'] ?? '') === ''
                        ? null
                        : (float) $validated['measurement_value'],
                'item_price' => (float) $validated['item_price'],
                'unit_price' =>
                    ($validated['unit_price'] ?? '') === ''
                        ? (float) $validated['item_price']
                        : (float) $validated['unit_price'],
                'stock_quantity' => $stock,
                'low_stock_threshold' =>
                    (float) ($validated['low_stock_threshold'] ?? 5),
            ]);

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * DELETE PRODUCT
     */
    public function destroy($id)
    {
        $userId = $this->currentUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            return redirect()
                ->route('inventory.index')
                ->with('error', 'Product not found.');
        }

        DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product deleted successfully!');
    }
}
