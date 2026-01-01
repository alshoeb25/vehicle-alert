<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class JwtAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization', '');
        if (!str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: missing Bearer token'], 401);
        }

        $token = substr($authHeader, 7);
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: malformed token'], 401);
        }

        [$headerB64, $payloadB64, $signatureB64] = $parts;

        // Validate signature
        $expectedSigRaw = hash_hmac('sha256', $headerB64 . '.' . $payloadB64, config('app.key'), true);
        $expectedSigB64 = rtrim(strtr(base64_encode($expectedSigRaw), '+/', '-_'), '=');
        if (!hash_equals($expectedSigB64, $signatureB64)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: invalid signature'], 401);
        }

        // Decode payload
        $payloadJson = base64_decode(strtr($payloadB64, '-_', '+/'));
        $payload = json_decode($payloadJson, true);
        if (!$payload || !isset($payload['exp']) || $payload['exp'] < time()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: token expired'], 401);
        }

        $userId = $payload['sub'] ?? null;
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: missing subject'], 401);
        }

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized: user not found'], 401);
        }

        // Set user for the request
        Auth::setUser($user);
        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
