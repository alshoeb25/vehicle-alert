<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BrevoMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 422);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetUrl = route('reset-password-form', ['token' => $token, 'email' => urlencode($request->email)]);
        $html = view('emails.reset-password', [
            'resetUrl' => $resetUrl,
            'name' => $user->name,
        ])->render();

        try {
            BrevoMailer::send(
                $request->email,
                'Reset Your Password',
                $html,
                $user->name,
                null,
                ['password', 'reset']
            );
        } catch (\Exception $e) {
            \Log::error('Failed to send reset password email: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to send password reset email',
            ], 500);
        }

        return response()->json([
            'message' => 'Password reset link sent to your email',
        ], 200);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return response()->json(['message' => 'Invalid reset token'], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
