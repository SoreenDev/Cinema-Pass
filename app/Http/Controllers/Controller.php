<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    function successResponse($data = [], $message = "", $statusCode = 200): JsonResponse
    {
        $success = true;
        return response()->json(
            compact('success', 'data', 'message'),
            $statusCode
        );
    }

    function successResponseWithAdditional($data = [], string $message = null, $status = 200, $additional = []): JsonResponse
    {
        return $data->additional(array_merge([
            'success' => true,
            'message' => $message ?? ''
        ], $additional))->response()->setStatusCode($status);
    }

    function errorResponse($message = "", $statusCode = 404, $data = []): JsonResponse
    {
        $success = false;
        return response()->json(compact('success', 'message'), $statusCode);
    }
}
