<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CURRENT USER
    |--------------------------------------------------------------------------
    */

    private function currentUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    private function ensureUser()
    {
        $userId = $this->currentUserId();

        abort_unless($userId, 403, 'Please log in first.');

        return $userId;
    }

    /*
    |--------------------------------------------------------------------------
    | REPORTS DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $userId = $this->ensureUser();

        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | SALES PERIOD
        |--------------------------------------------------------------------------
        */

        $salesPeriod = $request->query('period', 'daily');

        if (!in_array($salesPeriod, ['daily', 'weekly', 'monthly'], true)) {
            $salesPeriod = 'daily';
        }

        if ($salesPeriod === 'weekly') {
            $periodStart = $today->copy()->subDays(6)->startOfDay();
        } elseif ($salesPeriod === 'monthly') {
            $periodStart = $today->copy()->subDays(29)->startOfDay();
        } else {
            $periodStart = $today->copy()->startOfDay();
        }

        $periodEnd = $today->copy()->endOfDay();

        /*
        |--------------------------------------------------------------------------
        | TODAY'S SALES
        |--------------------------------------------------------------------------
        */

        $todaySales = DB::table('sales')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today->toDateString())
            ->get();

        $todayCash = (float) $todaySales
            ->where('sale_type', 'cash')
            ->sum('total_amount');

        $todayCredit = (float) $todaySales
            ->where('sale_type', 'credit')
            ->sum('total_amount');

        $todayGrandTotal = $todayCash + $todayCredit;

        /*
        |--------------------------------------------------------------------------
        | ITEMS SOLD TODAY
        |--------------------------------------------------------------------------
        */

        $todayItemsSold = (float) DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.user_id', $userId)
            ->whereDate('sales.created_at', $today->toDateString())
            ->sum('sale_items.quantity');

        /*
        |--------------------------------------------------------------------------
        | SELECTED PERIOD SALES SUMMARY
        |--------------------------------------------------------------------------
        */

        $salesByDate = DB::table('sales')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [
                $periodStart->toDateTimeString(),
                $periodEnd->toDateTimeString(),
            ])
            ->selectRaw("
                DATE(created_at) as date,
                SUM(
                    CASE
                        WHEN sale_type = 'cash' THEN total_amount
                        ELSE 0
                    END
                ) as cash_total,
                SUM(
                    CASE
                        WHEN sale_type = 'credit' THEN total_amount
                        ELSE 0
                    END
                ) as credit_total
            ")
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->get()
            ->keyBy('date');

        $itemsByDate = DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.user_id', $userId)
            ->whereBetween('sales.created_at', [
                $periodStart->toDateTimeString(),
                $periodEnd->toDateTimeString(),
            ])
            ->selectRaw("
                DATE(sales.created_at) as date,
                SUM(sale_items.quantity) as item_count
            ")
            ->groupByRaw('DATE(sales.created_at)')
            ->get()
            ->keyBy('date');

        $summary = $salesByDate->map(function ($row, $date) use ($itemsByDate) {
            $itemRow = $itemsByDate->get($date);

            return (object) [
                'date' => $date,
                'cash_total' => (float) $row->cash_total,
                'credit_total' => (float) $row->credit_total,
                'item_count' => (float) ($itemRow->item_count ?? 0),
            ];
        })->values();

        $selectedCash = (float) $summary->sum('cash_total');
        $selectedCredit = (float) $summary->sum('credit_total');
        $selectedGrandTotal = $selectedCash + $selectedCredit;
        $selectedItemsSold = (float) $summary->sum('item_count');

        /*
        |--------------------------------------------------------------------------
        | UNPAID BALANCES
        |--------------------------------------------------------------------------
        | Credit transactions minus payment transactions.
        |--------------------------------------------------------------------------
        */

        $unpaid = DB::table('debtors')
            ->leftJoin('transactions', function ($join) use ($userId) {
                $join->on('debtors.id', '=', 'transactions.debtor_id')
                    ->where('transactions.user_id', $userId)
                    ->whereIn('transactions.type', ['credit', 'payment']);
            })
            ->where('debtors.user_id', $userId)
            ->whereNull('debtors.deleted_at')
            ->select(
                'debtors.id',
                'debtors.full_name',
                'debtors.contact_number',
                DB::raw("
                    COALESCE(
                        SUM(
                            CASE
                                WHEN transactions.type = 'credit'
                                    THEN transactions.amount
                                WHEN transactions.type = 'payment'
                                    THEN -transactions.amount
                                ELSE 0
                            END
                        ), 0
                    ) as balance
                ")
            )
            ->groupBy(
                'debtors.id',
                'debtors.full_name',
                'debtors.contact_number'
            )
            ->havingRaw('balance > 0')
            ->orderByDesc('balance')
            ->get();

        $totalUnpaid = (float) $unpaid->sum('balance');

        /*
        |--------------------------------------------------------------------------
        | LOW STOCK PRODUCTS
        |--------------------------------------------------------------------------
        */

        $lowStock = DB::table('products')
            ->where('user_id', $userId)
            ->whereRaw('stock_quantity <= COALESCE(low_stock_threshold, 5)')
            ->orderBy('stock_quantity')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TRANSACTION HISTORY
        |--------------------------------------------------------------------------
        */

        $history = $this->getHistory($userId);

        /*
        |--------------------------------------------------------------------------
        | HISTORY FILTERS
        |--------------------------------------------------------------------------
        */

        $historyTypeFilter = $request->query('type', 'all');

        $allowedHistoryTypes = [
            'all',
            'cash',
            'e_wallet',
            'credit',
            'payment',
        ];

        if (!in_array($historyTypeFilter, $allowedHistoryTypes, true)) {
            $historyTypeFilter = 'all';
        }

        $historyDateFilter = $request->query('date', 'all');

        $filteredHistory = $history->filter(function ($item) use (
            $historyTypeFilter,
            $historyDateFilter
        ) {
            if (
                $historyTypeFilter !== 'all'
                && $item->type !== $historyTypeFilter
            ) {
                return false;
            }

            if ($historyDateFilter !== 'all' && $historyDateFilter) {
                $itemDate = Carbon::parse($item->date)->format('Y-m-d');

                if ($itemDate !== $historyDateFilter) {
                    return false;
                }
            }

            return true;
        })->values();

        /*
        |--------------------------------------------------------------------------
        | AVAILABLE HISTORY DATES
        |--------------------------------------------------------------------------
        */

        $historyDates = $history
            ->map(function ($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            })
            ->unique()
            ->sortDesc()
            ->values();

        $printDateFilter = $request->query('print_date', 'all');

        /*
        |--------------------------------------------------------------------------
        | STORE INFORMATION
        |--------------------------------------------------------------------------
        */

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        $storeName = $user->store_name ?? 'My Store';

        /*
        |--------------------------------------------------------------------------
        | RETURN REPORTS VIEW
        |--------------------------------------------------------------------------
        */

        return view('reports.index', compact(
            'salesPeriod',
            'summary',
            'selectedCash',
            'selectedCredit',
            'selectedGrandTotal',
            'selectedItemsSold',
            'todayCash',
            'todayCredit',
            'todayGrandTotal',
            'todayItemsSold',
            'unpaid',
            'totalUnpaid',
            'lowStock',
            'history',
            'filteredHistory',
            'historyTypeFilter',
            'historyDateFilter',
            'historyDates',
            'printDateFilter',
            'storeName'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | GET TRANSACTION HISTORY
    |--------------------------------------------------------------------------
    | Includes:
    | 1. Cash sales
    | 2. E-wallet sales
    | 3. Utang sales
    | 4. Payments
    |
    | Credit transactions are not added separately because the
    | corresponding Utang Sales are already retrieved from sales.
    |--------------------------------------------------------------------------
    */

    private function getHistory($userId)
    {
        /*
        |--------------------------------------------------------------------------
        | SALES
        |--------------------------------------------------------------------------
        */

        $sales = DB::table('sales')
            ->leftJoin('debtors', 'sales.debtor_id', '=', 'debtors.id')
            ->where('sales.user_id', $userId)
            ->select(
                'sales.id',
                'sales.customer_name',
                'sales.sale_type',
                'sales.total_amount',
                'sales.payment_method',
                'sales.created_at',
                'debtors.full_name as debtor_name'
            )
            ->get()
            ->map(function ($sale) {
                $saleType = strtolower((string) $sale->sale_type);
                $paymentMethod = strtolower((string) $sale->payment_method);

                $isCredit = $saleType === 'credit';
                $isWallet = !$isCredit && in_array(
                    $paymentMethod,
                    ['e_wallet', 'ewallet', 'gcash', 'maya'],
                    true
                );

                if ($isCredit) {
                    $type = 'credit';
                    $label = 'Utang Sale';
                } elseif ($isWallet) {
                    $type = 'e_wallet';
                    $label = 'E-wallet Sale';
                } else {
                    $type = 'cash';
                    $label = 'Cash Sale';
                }

                $customerName = $sale->debtor_name
                    ?: ($sale->customer_name ?: 'Walk-in Customer');

                return (object) [
                    'id' => $sale->id,
                    'record_id' => $sale->id,
                    'source' => 'sale',
                    'type' => $type,
                    'label' => $label,
                    'date' => $sale->created_at,
                    'date_key' => $sale->created_at,
                    'customer_name' => $customerName,
                    'debtor_name' => $customerName,
                    'payment_method' => $sale->payment_method
                        ?: ($isCredit ? 'N/A' : 'Cash'),
                    'amount' => (float) $sale->total_amount,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | PAYMENT TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $payments = DB::table('transactions')
            ->leftJoin('debtors', 'transactions.debtor_id', '=', 'debtors.id')
            ->where('transactions.user_id', $userId)
            ->where('transactions.type', 'payment')
            ->select(
                'transactions.id',
                'transactions.amount',
                'transactions.description',
                'transactions.payment_method',
                'transactions.created_at',
                'debtors.full_name as debtor_name'
            )
            ->get()
            ->map(function ($payment) {
                $customerName = $payment->debtor_name
                    ?: 'Walk-in Customer';

                return (object) [
                    'id' => $payment->id,
                    'record_id' => $payment->id,
                    'source' => 'transaction',
                    'type' => 'payment',
                    'label' => 'Payment',
                    'date' => $payment->created_at,
                    'date_key' => $payment->created_at,
                    'customer_name' => $customerName,
                    'debtor_name' => $customerName,
                    'payment_method' => $payment->payment_method ?: 'N/A',
                    'amount' => (float) $payment->amount,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | COMBINE AND SORT
        |--------------------------------------------------------------------------
        */

        return $sales
            ->concat($payments)
            ->sortByDesc(function ($item) {
                return $item->date;
            })
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | PRINT REPORT
    |--------------------------------------------------------------------------
    */

    public function print(Request $request)
    {
        $userId = $this->ensureUser();

        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | TODAY'S SALES
        |--------------------------------------------------------------------------
        */

        $todaySales = DB::table('sales')
            ->where('user_id', $userId)
            ->whereDate('created_at', $today->toDateString())
            ->get();

        $todayCash = (float) $todaySales
            ->where('sale_type', 'cash')
            ->sum('total_amount');

        $todayCredit = (float) $todaySales
            ->where('sale_type', 'credit')
            ->sum('total_amount');

        $todayGrandTotal = $todayCash + $todayCredit;

        /*
        |--------------------------------------------------------------------------
        | ITEMS SOLD TODAY
        |--------------------------------------------------------------------------
        */

        $todayItemsSold = (float) DB::table('sale_items')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.user_id', $userId)
            ->whereDate('sales.created_at', $today->toDateString())
            ->sum('sale_items.quantity');

        /*
        |--------------------------------------------------------------------------
        | UNPAID BALANCES
        |--------------------------------------------------------------------------
        */

        $unpaid = DB::table('debtors')
            ->leftJoin('transactions', function ($join) use ($userId) {
                $join->on('debtors.id', '=', 'transactions.debtor_id')
                    ->where('transactions.user_id', $userId)
                    ->whereIn('transactions.type', ['credit', 'payment']);
            })
            ->where('debtors.user_id', $userId)
            ->whereNull('debtors.deleted_at')
            ->select(
                'debtors.id',
                'debtors.full_name',
                'debtors.contact_number',
                DB::raw("
                    COALESCE(
                        SUM(
                            CASE
                                WHEN transactions.type = 'credit'
                                    THEN transactions.amount
                                WHEN transactions.type = 'payment'
                                    THEN -transactions.amount
                                ELSE 0
                            END
                        ), 0
                    ) as balance
                ")
            )
            ->groupBy(
                'debtors.id',
                'debtors.full_name',
                'debtors.contact_number'
            )
            ->havingRaw('balance > 0')
            ->orderByDesc('balance')
            ->get();

        $totalUnpaid = (float) $unpaid->sum('balance');

        /*
        |--------------------------------------------------------------------------
        | LOW STOCK
        |--------------------------------------------------------------------------
        */

        $lowStock = DB::table('products')
            ->where('user_id', $userId)
            ->whereRaw('stock_quantity <= COALESCE(low_stock_threshold, 5)')
            ->orderBy('stock_quantity')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TRANSACTION HISTORY
        |--------------------------------------------------------------------------
        */

        $history = $this->getHistory($userId);

        $printDateFilter = $request->query('date', 'all');

        if ($printDateFilter !== 'all' && $printDateFilter) {
            $history = $history->filter(function ($item) use ($printDateFilter) {
                return Carbon::parse($item->date)->format('Y-m-d')
                    === $printDateFilter;
            })->values();
        }

        /*
        |--------------------------------------------------------------------------
        | STORE NAME
        |--------------------------------------------------------------------------
        */

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        $storeName = $user->store_name ?? 'My Store';

        return view('reports.print', compact(
            'storeName',
            'todayCash',
            'todayCredit',
            'todayGrandTotal',
            'todayItemsSold',
            'unpaid',
            'totalUnpaid',
            'lowStock',
            'history',
            'printDateFilter'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ONE HISTORY ENTRY
    |--------------------------------------------------------------------------
    | This signature matches a route containing {source}/{id}.
    |--------------------------------------------------------------------------
    */

    public function deleteHistoryEntry(Request $request, $source, $id)
    {
        $userId = $this->ensureUser();

        abort_unless(in_array($source, ['sale', 'transaction'], true), 404);

        if ($source === 'sale') {
            $sale = DB::table('sales')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->first();

            if (!$sale) {
                return back()->with('error', 'Sale record not found.');
            }

            DB::transaction(function () use ($sale, $userId) {
                DB::table('sale_items')
                    ->where('sale_id', $sale->id)
                    ->delete();

                DB::table('sales')
                    ->where('id', $sale->id)
                    ->where('user_id', $userId)
                    ->delete();
            });
        } else {
            $payment = DB::table('transactions')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->where('type', 'payment')
                ->first();

            if (!$payment) {
                return back()->with('error', 'Payment record not found.');
            }

            DB::table('transactions')
                ->where('id', $payment->id)
                ->where('user_id', $userId)
                ->delete();
        }

        return back()->with('success', 'Transaction history entry deleted.');
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAR ALL HISTORY
    |--------------------------------------------------------------------------
    */

    public function clearHistory()
    {
        $userId = $this->ensureUser();

        DB::transaction(function () use ($userId) {
            $saleIds = DB::table('sales')
                ->where('user_id', $userId)
                ->pluck('id');

            if ($saleIds->isNotEmpty()) {
                DB::table('sale_items')
                    ->whereIn('sale_id', $saleIds)
                    ->delete();
            }

            DB::table('sales')
                ->where('user_id', $userId)
                ->delete();

            DB::table('transactions')
                ->where('user_id', $userId)
                ->whereIn('type', ['credit', 'payment'])
                ->delete();
        });

        return back()->with('success', 'All transaction history has been cleared.');
    }

    /*
    |--------------------------------------------------------------------------
    | BACKWARD-COMPATIBLE DELETE METHOD
    |--------------------------------------------------------------------------
    | Keep this method if an older route still points to deleteHistory.
    |--------------------------------------------------------------------------
    */

    public function deleteHistory(Request $request)
    {
        return $this->deleteHistoryEntry(
            $request,
            $request->input('source'),
            $request->input('id')
        );
    }
}