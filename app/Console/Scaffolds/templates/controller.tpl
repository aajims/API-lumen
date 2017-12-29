<?php

namespace ExampleNamespace;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;

class ExampleClass extends AbstractClass
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
        $array = [];

        return self::successResponse($array);
    }
}
