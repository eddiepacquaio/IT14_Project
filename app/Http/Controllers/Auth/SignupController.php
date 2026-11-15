<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    /**
     * Display the signup page.
     */
    public function show()
    {
        if (session()->has('logged_in_user')) {
            return redirect('/home/dashboard');
        }

        return view('auth.signup');
    }

    /**
     * Register a new Track&Tally account.
     */
    public function register(Request $request)
    {
        // Remove spaces, dashes, and other non-numeric characters.
        $request->merge([
            'phone_number' => preg_replace(
                '/\D/',
                '',
                $request->phone_number ?? ''
            ),
        ]);

        // Validate signup information.
        $request->validate([
            'store_name' => [
                'required',
                'string',
                'max:150',
            ],

            'owner_name' => [
                'required',
                'string',
                'max:150',
            ],

            'phone_number' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                'unique:users,phone_number',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

        ], [
            'phone_number.regex' => 'Enter a valid 11-digit Philippine mobile number starting with 09.',

            'phone_number.unique' => 'This phone number is already registered.',

            'password.confirmed' => 'Your passwords do not match.',

            'password.min' => 'Your password must contain at least 8 characters.',
        ]);

        try {

            // Insert the new user into the database.
            DB::table('users')->insertGetId([
                'phone_number' => $request->phone_number,
                'pin_code' => Hash::make($request->password),
                'store_name' => $request->store_name,
                'owner_name' => $request->owner_name,
            ]);

            // Redirect to login after successful registration.
            return redirect('/login')
                ->with(
                    'success',
                    'Your Track&Tally account was created successfully. You can now log in.'
                )
                ->with('last_phone', $request->phone_number);

        } catch (\Exception $e) {

            // Return to signup page if registration fails.
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
