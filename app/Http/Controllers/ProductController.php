<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Get the currently logged-in user
    private function getUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    // EDIT PRODUCT PAGE
    public function edit($id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            abort(404, 'Product not found.');
        }

        return view('inventory.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            abort(404, 'Product not found.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'unit' => 'required|string|max:50',
            'measurement_value' => 'nullable|numeric|min:0',
            'item_price' => 'required|numeric|min:0',
            'unit_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'required|numeric|min:0',
        ]);

        if ($validated['unit'] === 'piece' &&
            floor((float) $validated['stock_quantity']) != (float) $validated['stock_quantity']) {
            return back()
                ->withErrors(['stock_quantity' => 'Piece stock must be a whole number.'])
                ->withInput();
        }

        DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'name' => $validated['name'],
                'category' => $validated['category'] ?? null,
                'unit' => $validated['unit'],
                'measurement_value' => $validated['measurement_value'] ?? null,
                'item_price' => $validated['item_price'],
                'unit_price' => $validated['unit_price'] ?? 0,
                'stock_quantity' => $validated['stock_quantity'],
                'low_stock_threshold' => $validated['low_stock_threshold'],
            ]);

        return redirect('/inventory')
            ->with('success', 'Product updated successfully!');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            abort(404, 'Product not found.');
        }

        DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return redirect('/inventory')
            ->with('success', 'Product deleted successfully!');
    }
}
