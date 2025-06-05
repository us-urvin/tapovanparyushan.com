<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SanghProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $sangh = $user->sangh; // relationship
        // Add more eager loads if needed
        return view('sangh.profile', compact('user', 'sangh'));
    }

    public function edit()
    {
        $user = Auth::user();
        $sangh = $user->sangh;
        return view('sangh.edit', compact('user', 'sangh'));
    }
} 