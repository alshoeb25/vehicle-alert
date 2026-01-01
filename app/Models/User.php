<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'mobile_verified',
        'is_email_verified',
        'is_mobile_verified',
        'is_verified',
        'verification_step',
        'registration_method',
        'google_id',
        'facebook_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'mobile_verified' => 'boolean',
            'is_email_verified' => 'boolean',
            'is_mobile_verified' => 'boolean',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Generate JWT token for the user
     */
    public function generateJWT(): string
    {
        $payload = [
            'iss' => config('app.url'),
            'sub' => $this->id,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 7), // 7 days
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'is_verified' => $this->is_verified,
                'is_email_verified' => $this->is_email_verified,
                'is_mobile_verified' => $this->is_mobile_verified,
            ]
        ];

        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($payload);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, config('app.key'), true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    /**
     * Check if user is fully verified
     */
    public function isFullyVerified(): bool
    {
        if ($this->registration_method === 'email') {
            return $this->is_email_verified;
        } elseif ($this->registration_method === 'phone') {
            return $this->is_mobile_verified;
        } elseif ($this->google_id || $this->facebook_id) {
            return $this->is_verified;
        }
        return false;
    }
}
