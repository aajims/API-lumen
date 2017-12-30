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
        $foo = config('foo');
        $user = DB::connection('framework')
            ->select('SELECT * FROM user LIMIT 10');
        $array = [
            'foo'  => $foo,
            'user' => $user,
        ];

        return self::successResponse($array);
    }
}
