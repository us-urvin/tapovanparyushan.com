<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SanghProfileController extends Controller
{
    public function show()
    {
        if (Auth::user()->hasRole('Admin')) {
            return redirect()->route('admin.sangh.index')->with('success', 'Sangh profile updated successfully.');
        }
        
        $user = Auth::user();
        $sangh = $user->sangh->load('busTransportations', 'trainTransportations', 'otherSanghs', 'trustees'); 
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