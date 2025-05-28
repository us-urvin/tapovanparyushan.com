<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function checkPincode(Request $request)
    {
        $request->validate([
            'pincode' => 'required|string'
        ]);

        $user = User::whereHas('roles', function($query) {
            $query->where('name', 'Shangh');
        })->where('pincode', $request->pincode)
          ->where('status', 'accepted')
          ->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'shangh_name' => $user->shangh_name,
                    'trustee_name' => $user->name,
                    'email' => $user->email,
                    'mobile' => $user->mobile
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No Shangh found with this pincode. Please register first.'
        ], 404);
    }

    public function showOtpForm()
    {
        return view('auth.otp-verify');
    }
}
