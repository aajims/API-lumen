<?php

namespace App\Http\User\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Support\Facades\DB;

class ExampleController extends AbstractController
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
                  ->select('SELECT * FROM users LIMIT 10');
        $array = [
            'bar'  => $bar,
            'user' => $user,
        ];

        return self::successResponse($array);
    }
}
