<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellCartController extends Controller
{
    /**
     * Get the currently logged-in user.
     */
    private function getUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    /**
     * Display shopping cart.
     */
    public function index()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $cart = session()->get('sell_cart', []);

        $total = collect($cart)->sum(function ($item) {
            return (float) $item['price'] * (float) $item['quantity'];
        });

        return view('sell.cart', compact('cart', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request, $id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'quantity' => 'nullable|numeric|min:1',
            'mode' => 'nullable|in:item,package',
        ]);

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            abort(404, 'Product not found.');
        }

        $quantity = (float) ($validated['quantity'] ?? 1);
        $mode = $validated['mode'] ?? 'item';

        $availableStock = (float) $product->stock_quantity;

        if ($quantity > $availableStock) {
            return back()->with(
                'error',
                'Not enough stock available.'
            );
        }

        $price = $mode === 'package'
            ? (float) $product->unit_price
            : (float) $product->item_price;

        if ($price <= 0) {
            return back()->with(
                'error',
                'The selected selling price is invalid.'
            );
        }

        $cart = session()->get('sell_cart', []);

        $cartKey = (string) $id;

        if (isset($cart[$cartKey])) {

            // Do not combine different selling modes.
            if (($cart[$cartKey]['mode'] ?? 'item') !== $mode) {
                return back()->with(
                    'error',
                    'This product is already in your cart using a different selling mode.'
                );
            }

            $newQuantity = (float) $cart[$cartKey]['quantity'] + $quantity;

            if ($newQuantity > $availableStock) {
                return back()->with(
                    'error',
                    'Requested quantity exceeds available stock.'
                );
            }

            $cart[$cartKey]['quantity'] = $newQuantity;

        } else {

            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'unit' => $product->unit ?? 'piece',
                'mode' => $mode,
            ];
        }

        session()->put('sell_cart', $cart);

        return redirect()
            ->route('sell.cart')
            ->with('success', $product->name . ' added to cart successfully!');
    }

    /**
     * Update cart quantity.
     */
    public function update(Request $request, $id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $cart = session()->get('sell_cart', []);
        $cartKey = (string) $id;

        if (!isset($cart[$cartKey])) {
            return back()->with('error', 'Product not found in cart.');
        }

        $product = DB::table('products')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$product) {
            unset($cart[$cartKey]);
            session()->put('sell_cart', $cart);

            return back()->with('error', 'Product is no longer available.');
        }

        $quantity = (float) $validated['quantity'];

        if ($quantity > (float) $product->stock_quantity) {
            return back()->with(
                'error',
                'Requested quantity exceeds available stock.'
            );
        }

        $cart[$cartKey]['quantity'] = $quantity;

        session()->put('sell_cart', $cart);

        return back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove product from cart.
     */
    public function remove($id)
    {
        $cart = session()->get('sell_cart', []);

        unset($cart[(string) $id]);

        session()->put('sell_cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

    /**
     * Clear shopping cart.
     */
    public function clear()
    {
        session()->forget('sell_cart');

        return redirect()
            ->route('sell.cart')
            ->with('success', 'Shopping cart cleared.');
    }
}
