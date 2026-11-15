<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display login page.
     */
    public function show()
    {
        if (session()->has('user_id')) {
            return redirect('/dashboard');
        }

        return view('auth.login');
    }

    /**
     * Process user login using phone number and PIN/password.
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Find account using phone number.
        $user = DB::table('users')
            ->where('phone_number', $request->phone_number)
            ->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'login' => 'Incorrect phone number or password.',
                ])
                ->withInput($request->only('phone_number'));
        }

        // Check hashed passwords and older plain-text PINs.
        $storedPassword = (string) $user->pin_code;

        $isHashed = str_starts_with($storedPassword, '$2y$')
            || str_starts_with($storedPassword, '$argon2');

        $passwordIsCorrect = $isHashed
            ? Hash::check($request->password, $storedPassword)
            : hash_equals($storedPassword, $request->password);

        if (!$passwordIsCorrect) {
            return back()
                ->withErrors([
                    'login' => 'Incorrect phone number or password.',
                ])
                ->withInput($request->only('phone_number'));
        }

        // Regenerate session after successful login.
        $request->session()->regenerate();

        // Store logged-in user information.
        $request->session()->put([
            'user_id' => $user->id,
            'store_name' => $user->store_name,
            'owner_name' => $user->owner_name ?? '',
            'phone_number' => $user->phone_number,
        ]);

        // Redirect to dashboard.
        return redirect('/dashboard');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'You have successfully logged out.');
    }
}
