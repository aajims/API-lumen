<?php

namespace App\Http\Foo\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Support\Facades\DB;

class ExampleController extends FooController
{
    use ResultsetTrait;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction()
    {
        $config = config('foo');
        $list = DB::connection('framework')
                  ->select('SELECT * FROM logs LIMIT 10');
        $array = [
            'config' => $config,
            'list'   => $list,
        ];

        return self::successResponse($array);
    }
}
