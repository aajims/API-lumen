<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResultsetTrait
{
    /**
     * Return success JSON response.
     *
     * @param array  $array
     * @param string $msg
     * @param int    $code
     * @param int    $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResponse(
        array $array = [],
        string $msg = 'OK',
        int $code = 20000,
        int $status = 200
    )
    : JsonResponse {
        return self::response($array, $msg, $code, $status);
    }

    /**
     * Return warning JSON response.
     *
     * @param array  $array
     * @param string $msg
     * @param int    $code
     * @param int    $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function warningResponse(
        array $array = [],
        string $msg = 'OK',
        int $code = 40000,
        int $status = 200
    )
    : JsonResponse {
        return self::response($array, $msg, $code, $status);
    }

    /**
     * JSON response.
     *
     * @param array  $array
     * @param string $msg
     * @param int    $code
     * @param int    $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private static function response(
        array $array,
        string $msg,
        int $code,
        int $status
    )
    : JsonResponse {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $array,
        ];

        return response()->json($result, $status);
    }
}
