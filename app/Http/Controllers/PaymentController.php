<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display the payment form.
     */
    public function create($debtorId)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        // Find customer belonging to the logged-in user
        $debtor = DB::table('debtors')
            ->where('id', $debtorId)
            ->where('user_id', $userId)
            ->first();

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        // Calculate outstanding balance
        $credits = DB::table('transactions')
            ->where('debtor_id', $debtorId)
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->sum('amount');

        $payments = DB::table('transactions')
            ->where('debtor_id', $debtorId)
            ->where('user_id', $userId)
            ->where('type', 'payment')
            ->sum('amount');

        $balance = max(0, (float) $credits - (float) $payments);

        return view('debtors.add-payment', compact(
            'debtor',
            'balance'
        ));
    }

    /**
     * Save a customer payment.
     */
    public function store(Request $request, $debtorId)
    {
        $userId = Auth::id() ?? session('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $debtor = DB::table('debtors')
            ->where('id', $debtorId)
            ->where('user_id', $userId)
            ->first();

        if (!$debtor) {
            abort(404, 'Customer not found.');
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => [
                'required',
                'in:cash,e_wallet,e_banking'
            ],
            'wallet_provider' => [
                'nullable',
                'required_if:payment_method,e_wallet',
                'string',
                'max:100'
            ],
            'custom_wallet' => [
                'nullable',
                'required_if:wallet_provider,Other',
                'string',
                'max:100'
            ],
            'payment_provider' => [
                'nullable',
                'string',
                'max:100'
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:150'
            ],
            'description' => [
                'nullable',
                'string',
                'max:500'
            ],
        ]);

        $credits = DB::table('transactions')
            ->where('debtor_id', $debtorId)
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->sum('amount');

        $payments = DB::table('transactions')
            ->where('debtor_id', $debtorId)
            ->where('user_id', $userId)
            ->where('type', 'payment')
            ->sum('amount');

        $balance = max(0, (float) $credits - (float) $payments);

        $amount = (float) $validated['amount'];

        if ($amount > $balance) {
            return back()
                ->withInput()
                ->withErrors([
                    'amount' => 'Payment cannot exceed the outstanding balance of ₱'
                        . number_format($balance, 2)
                ]);
        }

        // Determine payment provider
        $provider = null;

        if ($validated['payment_method'] === 'e_wallet') {
            $provider = $validated['wallet_provider'] === 'Other'
                ? trim($validated['custom_wallet'] ?? '')
                : trim($validated['wallet_provider'] ?? '');

            if ($provider === '') {
                return back()
                    ->withInput()
                    ->withErrors([
                        'wallet_provider' => 'Please select or enter an e-wallet provider.'
                    ]);
            }
        } elseif ($validated['payment_method'] === 'e_banking') {
            $provider = trim($validated['payment_provider'] ?? '');
        }

        // Save payment transaction
        DB::table('transactions')->insert([
            'user_id' => $userId,
            'debtor_id' => $debtorId,
            'type' => 'payment',
            'amount' => $amount,
            'description' => $validated['description'] ?? 'Payment received',
            'payment_method' => $validated['payment_method'],
            'payment_provider' => $provider,
            'payment_reference' => $validated['payment_reference'] ?? null,
            'created_at' => now(),
        ]);

        return redirect()
            ->route('debtors.payments.create', [
                'debtorId' => $debtorId
            ])
            ->with('success', 'Payment successfully recorded!');
    }
}
