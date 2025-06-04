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
        $user = User::where('mobile', request()->get('mobile'))->first();
        if ($user) {
            return redirect()->route('login');
        }
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
            'reason_note' => ['nullable', 'string'],
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $mobile = request()->get('mobile');

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $mobile,
            'password' => Hash::make('password'),
            'pincode' => $validated['pincode'],
        ]);

        $sangh = $user->sangh()->create([
            'sangh_name' => $validated['sangh_name'],
            'sangh_address' => $validated['sangh_address'],
            'reason_note' => $validated['reason_note'] ?? null,
            'status' => 'pending',
        ]);

        if ($request->hasFile('document')) {
            $folderName = strtolower(str_replace(' ', '_', $sangh->sangh_name));
            $sangh->addMedia($request->file('document'))
                ->usingFileName($request->file('document')->getClientOriginalName())
                ->toMediaCollection('documents', [
                    'disk' => 'public',
                    'directory' => 'sangh/' . $folderName
                ]);
        }
        $user->assignRole('Shangh');

        return Redirect::route('login')->with('success', 'Registration successful! Please login.');
    }
}
