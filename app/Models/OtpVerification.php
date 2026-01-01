<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    protected $table = 'otp_verifications';

    public $timestamps = false;

    protected $fillable = [
        'mobile',
        'otp',
        'attempts',
        'created_at',
        'expires_at',
    ];
}
