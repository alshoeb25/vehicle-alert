<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^[0-9]{10,}$/',
        ]);

        // Check if mobile is already registered
        if (\App\Models\User::where('mobile', $request->mobile)->exists()) {
            return response()->json([
                'message' => 'This mobile number is already registered'
            ], 422);
        }

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Save or update OTP
        DB::table('otp_verifications')->updateOrInsert(
            ['mobile' => $request->mobile],
            [
                'otp' => $otp,
                'attempts' => 0,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(10),
            ]
        );

        // In production, send OTP via SMS (e.g., Twilio, AWS SNS)
        // For now, we'll log it or return in response for testing
        \Log::info("OTP for {$request->mobile}: {$otp}");

        return response()->json([
            'message' => 'OTP sent successfully',
            'otp' => $otp, // Remove this in production
        ], 200);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $otpRecord = DB::table('otp_verifications')
            ->where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        return response()->json([
            'message' => 'OTP verified successfully'
        ], 200);
    }

    public function verifyRegistrationOTP(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        // Check OTP validity
        $otpRecord = DB::table('otp_verifications')
            ->where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        // Find unverified user with this mobile
        $user = \App\Models\User::where('mobile', $request->mobile)
            ->where('mobile_verified', false)
            ->first();

        if (!$user) {
            return response()->json([
                'message' => 'No pending registration found for this mobile'
            ], 422);
        }

        // Mark mobile as verified
        $user->update([
            'mobile_verified' => true,
            'is_mobile_verified' => true,
            'is_verified' => true,
            'verification_step' => 'completed',
        ]);

        // Delete OTP record
        DB::table('otp_verifications')
            ->where('mobile', $request->mobile)
            ->delete();

        // Log user in
        \Illuminate\Support\Facades\Auth::login($user);

        // Generate JWT token
        $jwt = $user->generateJWT();

        return response()->json([
            'message' => 'Phone verification successful! Account created.',
            'verified' => true,
            'token' => $jwt,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->mobile,
                'is_verified' => $user->is_verified,
                'is_mobile_verified' => $user->is_mobile_verified,
            ]
        ], 200);
    }

    public function sendLoginOTP(Request $request)
    {
        $request->validate([
            'mobile' => 'regex:/^[0-9]{10,}$/',
        ]);

        $user = \App\Models\User::where('mobile', $request->mobile)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Mobile number not registered'
            ], 422);
        }

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('otp_verifications')->updateOrInsert(
            ['mobile' => $request->mobile],
            [
                'otp' => $otp,
                'attempts' => 0,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(10),
            ]
        );

        // In production, send OTP via SMS (e.g., Twilio, AWS SNS)
        \Log::info("Login OTP for {$request->mobile}: {$otp}");

        return response()->json([
            'message' => 'OTP sent successfully',
            'otp' => $otp, // Remove this in production
        ], 200);
    }
}
