<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

class DebtorDetailController extends Controller
{
    /**
     * Get the currently logged-in user ID.
     */
    private function getUserId()
    {
        return Auth::id() ?? session('user_id');
    }

    /**
     * Get a debtor belonging to the logged-in user.
     */
    private function getDebtor($id, $userId)
    {
        $query = DB::table('debtors')
            ->where('id', $id);

        if (Schema::hasColumn('debtors', 'user_id')) {
            $query->where('user_id', $userId);
        }

        if (Schema::hasColumn('debtors', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return $query->first();
    }

    /**
     * Check whether a transaction represents a payment.
     */
    private function isPayment($transaction)
    {
        $type = strtolower($transaction->type ?? '');

        return in_array($type, [
            'payment',
            'paid'
        ]);
    }

    /**
     * Calculate the debtor's outstanding balance.
     */
    private function calculateBalance($transactions)
    {
        $balance = 0;

        foreach ($transactions as $transaction) {
            $amount = (float) ($transaction->amount ?? 0);

            if ($this->isPayment($transaction)) {
                $balance -= $amount;
            } else {
                $balance += $amount;
            }
        }

        return max($balance, 0);
    }

    /**
     * DISPLAY CUSTOMER DETAILS
     * GET /debtors/{id}
     */
    public function show($id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login')
                ->with('error', 'Please log in first.');
        }

        if (!Schema::hasTable('debtors')) {
            return back()->with(
                'error',
                'The debtors table does not exist.'
            );
        }

        $debtor = $this->getDebtor($id, $userId);

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        // Get customer transactions.
        $transactions = collect();

        if (
            Schema::hasTable('transactions') &&
            Schema::hasColumn('transactions', 'debtor_id') &&
            Schema::hasColumn('transactions', 'amount')
        ) {
            $query = DB::table('transactions')
                ->where('debtor_id', $id);

            // Filter by user if the column exists.
            if (Schema::hasColumn('transactions', 'user_id')) {
                $query->where('user_id', $userId);
            }

            // Sort oldest to newest for running balance.
            if (Schema::hasColumn('transactions', 'created_at')) {
                $query->orderBy('created_at', 'asc');
            }

            if (Schema::hasColumn('transactions', 'id')) {
                $query->orderBy('id', 'asc');
            }

            $transactions = $query->get();
        }

        // Calculate running balance.
        $runningBalance = 0;

        foreach ($transactions as $transaction) {
            $amount = (float) ($transaction->amount ?? 0);

            if ($this->isPayment($transaction)) {
                $runningBalance -= $amount;
            } else {
                $runningBalance += $amount;
            }

            $transaction->running_balance = max(
                $runningBalance,
                0
            );
        }

        $balance = max($runningBalance, 0);

        return view('debtors.show', compact(
            'debtor',
            'transactions',
            'balance'
        ));
    }

    /**
     * DELETE A TRANSACTION
     * DELETE /debtors/{id}/transactions/{transactionId}
     */
    public function destroyTransaction($id, $transactionId)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login')
                ->with('error', 'Please log in first.');
        }

        if (!Schema::hasTable('transactions')) {
            return back()->with(
                'error',
                'The transactions table does not exist.'
            );
        }

        $debtor = $this->getDebtor($id, $userId);

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        $query = DB::table('transactions')
            ->where('id', $transactionId)
            ->where('debtor_id', $id);

        if (Schema::hasColumn('transactions', 'user_id')) {
            $query->where('user_id', $userId);
        }

        $transaction = $query->first();

        if (!$transaction) {
            return redirect()
                ->route('debtors.show', $id)
                ->with('error', 'Transaction not found.');
        }

        $query->delete();

        return redirect()
            ->route('debtors.show', $id)
            ->with('success', 'Transaction deleted successfully.');
    }

    /**
     * DELETE CUSTOMER
     * DELETE /debtors/{id}
     */
    public function destroy($id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login')
                ->with('error', 'Please log in first.');
        }

        $debtor = $this->getDebtor($id, $userId);

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        // Get customer transactions to check outstanding balance.
        $transactions = collect();

        if (
            Schema::hasTable('transactions') &&
            Schema::hasColumn('transactions', 'debtor_id') &&
            Schema::hasColumn('transactions', 'amount')
        ) {
            $query = DB::table('transactions')
                ->where('debtor_id', $id);

            if (Schema::hasColumn('transactions', 'user_id')) {
                $query->where('user_id', $userId);
            }

            $transactions = $query->get();
        }

        $balance = $this->calculateBalance($transactions);

        // Prevent deleting customers who still owe money.
        if ($balance > 0) {
            return redirect()
                ->route('debtors.show', $id)
                ->with(
                    'error',
                    'You cannot delete this customer because they still have an outstanding balance of ₱' .
                    number_format($balance, 2) . '.'
                );
        }

        $query = DB::table('debtors')
            ->where('id', $id);

        if (Schema::hasColumn('debtors', 'user_id')) {
            $query->where('user_id', $userId);
        }

        // Soft delete if the table supports it.
        if (Schema::hasColumn('debtors', 'deleted_at')) {
            $update = [
                'deleted_at' => now()
            ];

            if (Schema::hasColumn('debtors', 'updated_at')) {
                $update['updated_at'] = now();
            }

            $query->update($update);
        } else {
            // Permanently delete if no soft-delete column exists.
            $query->delete();
        }

        return redirect()
            ->route('debtors.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
