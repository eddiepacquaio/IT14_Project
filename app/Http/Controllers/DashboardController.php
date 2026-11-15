<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the logged-in user ID
        $authUser = Auth::user();
        $userId = $authUser?->id ?? session('user_id');

        // Redirect to login if no user is logged in
        if (!$userId) {
            return redirect('/login');
        }

        // Get the actual logged-in user's record
        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        if (!$user) {
            session()->forget('user_id');
            return redirect('/login');
        }

        // Get owner's name from the users table
        // Adjust these column names to match your actual migration.
        $ownerName = $user->full_name
            ?? $user->name
            ?? $user->owner_name
            ?? 'Store Owner';

        // Get store name
        $storeName = $user->store_name ?? 'My Store';

        // Today's date
        $today = Carbon::today();

        $todayLabel = Carbon::now()->format('l, F d, Y');

        // Default dashboard values
        $stats = [
            'todaySales' => 0,
            'outstanding' => 0,
            'lowStockCount' => 0,
            'outOfStockCount' => 0,
            'cashSales' => 0,
            'utangSales' => 0,
            'itemsSold' => 0,
        ];

        // Today's sales
        $stats['todaySales'] = DB::table('sales')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        // Outstanding utang
        $credit = DB::table('transactions')
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->sum('amount');

        $payments = DB::table('transactions')
            ->where('user_id', $userId)
            ->where('type', 'payment')
            ->sum('amount');

        $stats['outstanding'] = max(0, $credit - $payments);

        // Low stock products
        $stats['lowStockCount'] = DB::table('products')
            ->where('user_id', $userId)
            ->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->where('stock_quantity', '>', 0)
            ->count();

        // Out of stock products
        $stats['outOfStockCount'] = DB::table('products')
            ->where('user_id', $userId)
            ->where('stock_quantity', '<=', 0)
            ->count();

        // Cash sales today
        $stats['cashSales'] = DB::table('sales')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->where('sale_type', 'cash')
            ->sum('total_amount');

        // Utang sales today
        $stats['utangSales'] = DB::table('sales')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->where('sale_type', 'utang')
            ->sum('total_amount');

        // Total items sold today
        $stats['itemsSold'] = DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.user_id', $userId)
            ->whereDate('sales.created_at', $today)
            ->sum('sale_items.quantity');

        return view('dashboard.index', compact(
            'stats',
            'storeName',
            'ownerName',
            'todayLabel'
        ));
    }
}
