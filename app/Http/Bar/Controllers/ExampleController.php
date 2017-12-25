<?php

namespace App\Http\Bar\Controllers;

use Illuminate\Support\Facades\DB;

class ExampleController extends BarController
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
        $bar = config('bar');
        $user = DB::connection('framework')
            ->select('SELECT * FROM user LIMIT 1');
        $array = [
            'bar'  => $bar,
            'user' => $user,
        ];

        return $array;
    }
}
