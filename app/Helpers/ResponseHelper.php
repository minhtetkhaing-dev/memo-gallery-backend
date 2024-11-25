<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    public static function success(mixed $message, mixed $data = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
                'data' => $data,
            ],
            $status
        );
    }

    public static function fail(mixed $message, int $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json(
            [
                'message' => $message
            ],
            $status
        );
    }
}
