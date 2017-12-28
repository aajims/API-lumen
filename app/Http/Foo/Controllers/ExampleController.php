<?php

namespace App\Http\Foo\Controllers;

use Illuminate\Support\Facades\DB;

class ExampleController extends FooController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @return array
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

        return $array;
    }
}
