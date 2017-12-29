<?php

namespace App\Http\Bar\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Support\Facades\DB;

class ExampleController extends BarController
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
        $bar = config('bar');
        $user = DB::connection('homestead')
            ->select('SELECT * FROM user LIMIT 10');
        $array = [
            'bar'  => $bar,
            'user' => $user,
        ];

        return self::successResponse($array);
    }
}
