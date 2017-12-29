<?php

namespace App\Http\Bar\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;

class TestController extends BaseController
{
    use ResultsetTrait;

    /**
     * List action.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction(Request $request)
    {
        return self::successResponse([$request->path()]);
    }
}
