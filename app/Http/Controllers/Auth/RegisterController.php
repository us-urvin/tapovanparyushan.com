<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
            'sangh_name' => ['required', 'string', 'max:255'],
            'sangh_address' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'], // trustee name
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'regex:/^\d{10}$/', 'unique:users'],
            'reason_note' => ['nullable', 'string'],
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'password' => Hash::make('password'),
            'pincode' => $validated['pincode'],
        ]);

        $user->assignRole('Shangh');

        $sangh = $user->sangh()->create([
            'sangh_name' => $validated['sangh_name'],
            'sangh_address' => $validated['sangh_address'],
            'reason_note' => $validated['reason_note'] ?? null,
            'status' => 'pending',
        ]);

        $sangh->trustees()->create([
            'first_name' => $validated['name'],
            'phone' => $validated['mobile'],
            'email' => $validated['email'],
        ]);

        if (isset($request->document)) {
            $sangh->addMediaFromRequest('document')->toMediaCollection('sangh_pdf_document');
        }

        return Redirect::route('login')->with('success', 'Registration successful! You will get email once admin will approve your profile.');
    }
}
