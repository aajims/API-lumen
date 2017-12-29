<?php

namespace App\Http\Foos\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;

class TestController extends BaseController
{
    use ResultsetTrait;

    public function listAction(Request $request)
    {
        return self::successResponse([$request->path()]);
    }
}
