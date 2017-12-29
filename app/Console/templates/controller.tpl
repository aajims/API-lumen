<?php

namespace ExampleNamespace;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;

class ExampleController extends BaseController
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
