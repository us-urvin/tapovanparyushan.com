<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'pincode' => ['required', 'string', 'max:255'],
            'shangh_name' => ['required', 'string', 'max:255'],
            'shangh_address' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'], // trustee name
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'reason_note' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('changeme123'), // Default password, should be changed later
            'shangh_name' => $validated['shangh_name'],
            'shangh_address' => $validated['shangh_address'],
            'reason_note' => $validated['reason_note'] ?? null,
            'pincode' => $validated['pincode'],
        ]);
        $user->assignRole('Shangh');

        return Redirect::route('login')->with('success', 'Registration successful! Please login.');
    }
}
