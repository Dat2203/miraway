<?php

namespace App\Http\Utils;

class ResponseHelper
{
    /**
     * Generate a standardized JSON response.
     *
     * @param string $message
     * @param int $statusCode
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function createResponse(string $message, int $statusCode, $data = null)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $statusCode,
            'data' => $data
        ], $statusCode);
    }
}