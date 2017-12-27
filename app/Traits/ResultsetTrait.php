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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResponse(
        array $array = [],
        string $msg = 'OK',
        int $code = 20020
    )
    : JsonResponse {
        return self::response(true, $array, $msg, $code);
    }

    /**
     * Return warning JSON response.
     *
     * @param array  $array
     * @param string $msg
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function warningResponse(
        array $array = [],
        string $msg = 'OK',
        int $code = 40020
    )
    : JsonResponse {
        return self::response(false, $array, $msg, $code);
    }

    /**
     * JSON response.
     *
     * @param bool   $status
     * @param array  $array
     * @param string $msg
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private static function response(
        bool $status,
        array $array,
        string $msg,
        int $code
    ) {
        $result = [
            'status' => $status,
            'data'   => $array,
            'msg'    => $msg,
            'code'   => $code,
        ];

        return response()->json($result, 200);
    }
}
