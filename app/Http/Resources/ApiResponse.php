<?php

namespace App\Http\Resources;

/**
 * API Response Helper for consistent JSON responses
 */
class ApiResponse
{
    /**
     * Return success response
     */
    public static function success($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return error response
     */
    public static function error($message = 'Error', $code = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    /**
     * Return unauthorized response
     */
    public static function unauthorized($message = 'Unauthorized')
    {
        return self::error($message, 401);
    }

    /**
     * Return forbidden response
     */
    public static function forbidden($message = 'Forbidden')
    {
        return self::error($message, 403);
    }

    /**
     * Return not found response
     */
    public static function notFound($message = 'Not Found')
    {
        return self::error($message, 404);
    }

    /**
     * Return validation error response
     */
    public static function validationError($errors, $message = 'Validation failed')
    {
        return self::error($message, 422, $errors);
    }
}
