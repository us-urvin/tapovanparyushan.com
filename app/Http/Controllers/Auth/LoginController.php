<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('mobile_number')) {
            Otp::where('mobile', Session::get('mobile_number'))->delete();
            Session::forget('mobile_number');
        }
        return view('auth.login');
    }

    public function checkPincode(Request $request)
    {
        $request->validate([
            'pincode' => 'required|string'
        ]);

        $user = User::whereHas('roles', function($query) {
            $query->where('id', 2);
        })->with('sangh')->where('pincode', $request->pincode)
          ->where('status', 'accepted')
          ->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'sangh_name' => $user->sangh->sangh_name,
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

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|regex:/^\d{10}$/'
        ]);

        $user = User::where('mobile', $request->mobile)->first();
        
        // Delete any existing unused OTPs for this mobile number
        Otp::where('mobile', $request->mobile)
           ->where('is_used', false)
           ->delete();
        
        // Generate OTP
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store OTP in database
        Otp::create([
            'user_id' => $user ? $user->id : null,
            'mobile' => $request->mobile,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5), // OTP valid for 5 minutes
            'is_used' => false
        ]);

        // Store mobile number in session
        Session::put('mobile_number', $request->mobile);

        // TODO: Send OTP via SMS service
        // For now, we'll just return it in the response
        return redirect()->route('otp.verify')->with('temp_otp', $otp);
    }

    public function showOtpForm()
    {
        if (!Session::has('mobile_number')) {
            return redirect()->route('login')->with('error', 'Please enter your mobile number first.');
        }
        $otp = Otp::where('mobile', Session::get('mobile_number'))->where('is_used', 0)->where('expires_at', '>', Carbon::now())->pluck('otp')->first();
        return view('auth.otp-verify')->with('temp_otp', $otp);
    }

    public function verifyOtp(Request $request)
    {
        if (!Session::has('mobile_number')) {
            return redirect()->route('login')->with('error', 'Please enter your mobile number first.');
        }

        $request->validate([
            'otp' => 'required|array|size:4'
        ]);

        $enteredOtp = implode('', $request->otp);
        $mobileNumber = Session::get('mobile_number');

        // First check if user exists
        $user = User::where('mobile', $mobileNumber)->first();

        if ($user) {
            // User exists, verify OTP from user's OTPs
            $otp = Otp::where('user_id', $user->id)
                ->where('otp', $enteredOtp)
                ->where('is_used', false)
                ->where('expires_at', '>', Carbon::now())
                ->latest()
                ->first();
        } else {
            // User doesn't exist, verify OTP from unregistered OTPs
            $otp = Otp::where('mobile', $mobileNumber)
                ->whereNull('user_id')
                ->where('otp', $enteredOtp)
                ->where('is_used', false)
                ->where('expires_at', '>', Carbon::now())
                ->latest()
                ->first();
        }

        if (!$otp) {
            return back()->with('error', 'Invalid or expired OTP.');
        }

        // Mark OTP as used
        $otp->update(['is_used' => true]);

        // Clear mobile number from session
        Session::forget('mobile_number');

        if ($user) {
            // Log the user in
            Auth::login($user);
            return redirect()->route('sangh.profile');
        } else {
            // User needs to register
            return redirect()->route('register', ['mobile' => $mobileNumber]);
        }
    }
}
