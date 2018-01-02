<?php

namespace App\Http\User\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    use ResultsetTrait;

    /**
     * User create action.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAction(Request $request)
    {
        $array = [];

        return self::successResponse($array);
    }
}
