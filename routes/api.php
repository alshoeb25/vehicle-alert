<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes - Version 1
|--------------------------------------------------------------------------
|
| All API routes are versioned with the /api/v1/ prefix.
| This allows for future API versions (v2, v3, etc.) without breaking changes.
|
| Base URL: /api/v1/
|
| All responses are JSON with proper HTTP status codes and messages
| Response format:
| {
|     "success": true|false,
|     "message": "Response message",
|     "data": {...},
|     "errors": {...} (optional, on validation errors)
| }
|
| Authentication Routes:
| - POST /api/v1/register              - Register new user (email or phone)
| - POST /api/v1/login                 - User login (password or OTP)
| - POST /api/v1/logout                - User logout
| - POST /api/v1/resend-verification-email - Resend verification email
|
| OTP Routes:
| - POST /api/v1/send-otp              - Send OTP for phone registration
| - POST /api/v1/send-login-otp        - Send OTP for login
| - POST /api/v1/verify-otp            - Verify OTP
| - POST /api/v1/verify-registration-otp - Verify OTP during registration
|
| Profile Routes (Protected):
| - GET  /api/v1/profile               - Get user profile
| - POST /api/v1/profile/update        - Update profile information
| - POST /api/v1/profile/update-email  - Update email address
| - POST /api/v1/profile/verify-email/{token} - Verify new email
| - POST /api/v1/profile/update-mobile - Update mobile number
| - POST /api/v1/profile/verify-mobile - Verify new mobile number
|
| Status Codes:
| - 200: Success
| - 201: Created
| - 400: Bad Request
| - 401: Unauthorized
| - 403: Forbidden
| - 404: Not Found
| - 422: Validation Error
| - 500: Server Error
|
*/

// API Version 1 with JSON responses
Route::prefix('v1')
    ->middleware(['api', 'force.json.response'])
    ->group(function () {
    // Authentication API Routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Resend verification email
    Route::post('/resend-verification-email', [AuthController::class, 'resendVerificationEmail']);

    // OTP Routes
    Route::post('/send-otp', [OTPController::class, 'sendOTP']);
    Route::post('/send-login-otp', [OTPController::class, 'sendLoginOTP']);
    Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);
    Route::post('/verify-registration-otp', [OTPController::class, 'verifyRegistrationOTP']);

    // Profile Routes (Protected via JWT)
    Route::middleware('jwt.auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'getProfile']);
        Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
        Route::post('/profile/update-email', [ProfileController::class, 'updateEmail']);
        Route::post('/profile/verify-email/{token}', [ProfileController::class, 'verifyNewEmail']);
        Route::post('/profile/update-mobile', [ProfileController::class, 'updateMobile']);
        Route::post('/profile/verify-mobile', [ProfileController::class, 'verifyNewMobile']);
    });

    // Contact Form
    Route::post('/contact', [ContactController::class, 'store']);
});
