<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function index()
    {
        return view('auth.otp');
    }

    public function otpLogin(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $checkUser = User::where('email', $request->email)->first();
        if (is_null($checkUser)) {
            return redirect()->back()->with('error', 'User not found.');
        } else {
            // Generate OTP and send it to user's registered mobile number
            $otp = mt_rand(123456, 999999);
            $now = now();
            $user = User::where('email', $request->email)->update([
                'otp' => $otp,
                'expires_at' => $now->addMinutes(10),
            ]);

            return redirect()->route('otp-confirm')->with('otp', $otp);
        }

    }

    public function verifyOtp(Request $request) {}
}
