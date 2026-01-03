<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BrevoMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'registration_method' => 'required|in:email,phone',
            'terms' => 'accepted',
        ]);

        if ($request->registration_method === 'email') {
            $validator->addRules([
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } else {
            $validator->addRules([
                'mobile' => 'required|string|min:10|unique:users',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        try {
            // Handle phone registration - just store mobile, OTP verification happens next
            if ($request->registration_method === 'phone') {
                // Create user with unverified mobile
                $user = User::create([
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'mobile_verified' => false,
                    'is_mobile_verified' => false,
                    'is_verified' => false,
                    'verification_step' => 'otp_pending',
                    'registration_method' => 'phone',
                    'password' => Hash::make(Str::random(16)), // Random password for phone users
                ]);

                return response()->json([
                    'message' => 'Phone number registered. OTP verification required.',
                    'verification_pending' => true,
                    'user_id' => $user->id,
                    'mobile' => $request->mobile,
                ], 200);
            }

            // Handle email registration with verification link
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_email_verified' => false,
                'is_verified' => false,
                'verification_step' => 'email_pending',
                'registration_method' => 'email',
            ]);

            $token = Str::random(64);
            DB::table('email_verifications')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
                'expires_at' => now()->addHours(24),
            ]);

            $verificationUrl = route('verify-email', ['token' => $token, 'email' => urlencode($request->email)]);
            $html = view('emails.verify-email', [
                'verificationUrl' => $verificationUrl,
                'name' => $request->name,
            ])->render();

            BrevoMailer::send(
                $request->email,
                'Verify Your Email Address',
                $html,
                $request->name,
                null,
                ['verification', 'signup']
            );

            return response()->json([
                'message' => 'Registration successful! Verification link sent to your email.',
                'verification_pending' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    public function verifyEmail(Request $request)
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
            return redirect('/login')->withErrors(['message' => 'Invalid or expired verification link']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'User not found']);
        }

        $user->update([
            'email_verified_at' => now(),
            'is_email_verified' => true,
            'is_verified' => true,
            'verification_step' => 'completed',
        ]);

        DB::table('email_verifications')
            ->where('email', $request->email)
            ->delete();

        Auth::login($user);

        return redirect('/')->with('success', 'Email verified successfully!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'remember' => 'nullable|boolean',
        ]);

        // OTP Login
        if ($request->has('login_method') && $request->login_method === 'otp') {
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

            $user = User::where('mobile', $request->mobile)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 422);
            }

            // Check if mobile is verified
            if (!$user->is_mobile_verified) {
                return response()->json([
                    'message' => 'Mobile number not verified. Please complete OTP verification first.',
                    'verification_required' => true,
                    'mobile' => $user->mobile,
                ], 403);
            }

            DB::table('otp_verifications')
                ->where('mobile', $request->mobile)
                ->delete();

            $jwt = $user->generateJWT();

            return response()->json([
                'message' => 'Login successful',
                'token' => $jwt,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'is_verified' => $user->is_verified,
                    'is_email_verified' => $user->is_email_verified,
                    'is_mobile_verified' => $user->is_mobile_verified,
                ]
            ], 200);
        }

        // Password Login (email or phone)
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('mobile', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 422);
        }

        // Check verification status
        if ($user->registration_method === 'email' && !$user->is_email_verified) {
            // Resend verification email
            $token = Str::random(64);
            DB::table('email_verifications')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now(),
                    'expires_at' => now()->addHours(24),
                ]
            );

            try {
                $verificationUrl = route('verify-email', ['token' => $token, 'email' => urlencode($user->email)]);
                $html = view('emails.verify-email', [
                    'verificationUrl' => $verificationUrl,
                    'name' => $user->name,
                ])->render();

                BrevoMailer::send(
                    $user->email,
                    'Verify Your Email Address',
                    $html,
                    $user->name,
                    null,
                    ['verification', 'login']
                );
            } catch (\Exception $e) {
                \Log::error('Failed to send verification email: ' . $e->getMessage());
            }

            return response()->json([
                'message' => 'Email not verified. A new verification link has been sent to your email.',
                'verification_required' => true,
                'verification_type' => 'email',
                'email' => $user->email,
            ], 403);
        }

        if ($user->registration_method === 'phone' && !$user->is_mobile_verified) {
            return response()->json([
                'message' => 'Mobile number not verified. Please verify with OTP.',
                'verification_required' => true,
                'verification_type' => 'mobile',
                'mobile' => $user->mobile,
            ], 403);
        }

        Auth::login($user, $request->remember);

        $jwt = $user->generateJWT();

        return response()->json([
            'message' => 'Login successful',
            'token' => $jwt,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'is_verified' => $user->is_verified,
                'is_email_verified' => $user->is_email_verified,
                'is_mobile_verified' => $user->is_mobile_verified,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->is_email_verified) {
            return response()->json(['message' => 'Email already verified'], 400);
        }

        // Generate new token
        $token = Str::random(64);
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => now(),
                'expires_at' => now()->addHours(24),
            ]
        );

        try {
            $verificationUrl = route('verify-email', ['token' => $token, 'email' => urlencode($user->email)]);
            $html = view('emails.verify-email', [
                'verificationUrl' => $verificationUrl,
                'name' => $user->name,
            ])->render();

            BrevoMailer::send(
                $user->email,
                'Verify Your Email Address',
                $html,
                $user->name,
                null,
                ['verification', 'resend']
            );

            return response()->json(['message' => 'Verification email sent successfully'], 200);
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send verification email'], 500);
        }
    }
}

