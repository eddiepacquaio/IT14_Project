<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function show()
    {
        if (session()->has('logged_in_user')) {
            return redirect('/home/dashboard');
        }

        return view('auth.signup');
    }

    public function register(Request $request)
    {
        $request->merge([
            'phone_number' => preg_replace(
                '/\D/',
                '',
                $request->phone_number ?? ''
            ),
        ]);

        $request->validate([
            'store_name' => ['required', 'string', 'max:150'],
            'owner_name' => ['required', 'string', 'max:150'],
            'phone_number' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                'unique:users,phone_number',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'phone_number.regex' => 'Enter a valid 11-digit Philippine mobile number starting with 09.',
            'phone_number.unique' => 'This phone number is already registered.',
            'password.confirmed' => 'Your passwords do not match.',
            'password.min' => 'Your password must contain at least 8 characters.',
        ]);

        try {
            $userId = DB::table('users')->insertGetId([
                'phone_number' => $request->phone_number,
                'pin_code' => Hash::make($request->password),
                'store_name' => $request->store_name,
                'owner_name' => $request->owner_name,
            ]);

            return redirect('/login')
                ->with('success', 'Your Track&Tally account was created successfully. You can now log in.')
                ->with('last_phone', $request->phone_number);

        } catch (\Exception $e) {
            return back()
                ->withInput($request->except([
                    'password',
                    'password_confirmation',
                ]))
                ->withErrors([
                    'signup' => 'Unable to create your account. Please try again.',
                ]);
        }
    }
}