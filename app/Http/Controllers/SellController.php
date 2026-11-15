<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    public function index(Request $request)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect('/login')->with('error', 'Please log in first.');
        }

        $search = trim($request->query('search', ''));

        $products = DB::table('products')
            ->where('user_id', $userId)
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('sell.index', compact('products', 'search'));
    }
}
