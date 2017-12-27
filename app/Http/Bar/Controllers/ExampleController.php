<?php

namespace App\Http\Bar\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Support\Facades\DB;

class ExampleController extends BarController
{
    use ResultsetTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction()
    {
        $user = DB::connection('framework')
            ->select('SELECT * FROM user LIMIT 2');

        return self::successResponse($user);
    }

    public function logAction()
    {
    }
}
