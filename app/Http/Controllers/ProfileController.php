<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function getProfile()
    {
        $user = Auth::user();
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'email_verified' => $user->email_verified_at !== null,
            'mobile_verified' => $user->mobile_verified,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($request->email === $user->email) {
            return response()->json(['message' => 'New email must be different'], 422);
        }

        $token = Str::random(64);
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
                'expires_at' => now()->addHours(24),
            ]
        );

        Mail::send(new VerifyEmailMail($request->email, $token, $user->name));

        return response()->json([
            'message' => 'Verification link sent to new email address',
        ], 200);
    }

    public function verifyNewEmail(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
        ]);

        $verification = DB::table('email_verifications')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verification) {
            return redirect('/profile')->withErrors(['message' => 'Invalid or expired verification link']);
        }

        $user = Auth::user();
        $user->update(['email' => $request->email, 'email_verified_at' => now()]);

        DB::table('email_verifications')
            ->where('email', $request->email)
            ->delete();

        return redirect('/profile')->with('success', 'Email updated and verified successfully!');
    }

    public function updateMobile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'mobile' => 'required|string|unique:users,mobile,' . $user->id,
        ]);

        if ($request->mobile === $user->mobile) {
            return response()->json(['message' => 'New mobile must be different'], 422);
        }

        // Send OTP to new mobile
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

        // In production, send OTP via SMS
        \Log::info("OTP for {$request->mobile}: {$otp}");

        return response()->json([
            'message' => 'OTP sent to new mobile number',
        ], 200);
    }

    public function verifyNewMobile(Request $request)
    {
        $user = Auth::user();

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
            return response()->json(['message' => 'Invalid or expired OTP'], 422);
        }

        $user->update(['mobile' => $request->mobile, 'mobile_verified' => true]);

        DB::table('otp_verifications')
            ->where('mobile', $request->mobile)
            ->delete();

        return response()->json(['message' => 'Mobile number updated and verified successfully'], 200);
    }
}
