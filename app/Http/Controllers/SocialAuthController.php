<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Update Google ID if not set
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'is_verified' => true,
                        'is_email_verified' => true,
                        'email_verified_at' => $user->email_verified_at ?? now(),
                    ]);
                }
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(str()->random(24)), // Random password for social login users
                    'email_verified_at' => now(),
                    'is_email_verified' => true,
                    'is_verified' => true,
                    'registration_method' => 'email',
                ]);
            }

            Auth::login($user);

            return redirect('/')->with('success', 'Welcome ' . $user->name . '!');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login with Google. Please try again.');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $fbUser = Socialite::driver('facebook')->user();
            $user = User::where('email', $fbUser->getEmail())->first();
            if ($user) {
                if (!$user->facebook_id) {
                    $user->update([
                        'facebook_id' => $fbUser->getId(),
                        'is_verified' => true,
                        'is_email_verified' => true,
                        'email_verified_at' => $user->email_verified_at ?? now(),
                    ]);
                }
            } else {
                $user = User::create([
                    'name' => $fbUser->getName(),
                    'email' => $fbUser->getEmail(),
                    'facebook_id' => $fbUser->getId(),
                    'password' => bcrypt(str()->random(24)),
                    'email_verified_at' => now(),
                    'is_email_verified' => true,
                    'is_verified' => true,
                    'registration_method' => 'email',
                ]);
            }
            Auth::login($user);
            return redirect('/')->with('success', 'Welcome ' . $user->name . '!');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login with Facebook. Please try again.');
        }
    }
}
