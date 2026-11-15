<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private function getUserId()
    {
        return session('user_id');
    }

    public function index()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        if (!$user) {
            session()->forget('user_id');
            return redirect('/login');
        }

        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'store_name' => ['required', 'string', 'max:255'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'phone_number')->ignore($userId),
            ],
        ]);

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'store_name' => trim($validated['store_name']),
                'owner_name' => trim($validated['owner_name'] ?? ''),
                'phone_number' => trim($validated['phone_number']),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Your store profile has been updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'new_password.min' => 'Your new password must contain at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        if (!$user || empty($user->password) ||
            !Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'Your current password is incorrect.',
                ])
                ->withInput();
        }

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'password' => Hash::make($validated['new_password']),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('profile.index')
            ->with('password_success', 'Your password has been changed successfully.');
    }
}