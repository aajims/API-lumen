<?php

namespace App\Http\User\Controllers;

use App\Events\SendEmailEvent;
use App\Jobs\SendEmailReminderJob;
use App\Models\User\UserModel;
use App\Traits\ResultsetTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class UserController extends AbstractController
{
    use ResultsetTrait;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
    }

    /**
     * User create action.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAction(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);
        $attributes = $request->only('email', 'password');

        try {
            $object = factory(UserModel::class)->create($attributes);
        } catch (QueryException $e) {
            return self::warningResponse([], $e->getMessage());
        }

        Event::fire(new SendEmailEvent($object));
        $this->dispatch(new SendEmailReminderJob($object));
        $user = $object->toArray();

        return self::successResponse($user);
    }

    /**
     * User list action.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction()
    {
        $config = config('user');
        $user = DB::connection('homestead')
                  ->select('SELECT * FROM users LIMIT 10');
        $array = [
            'config' => $config,
            'user'   => $user,
        ];

        return self::successResponse($array);
    }

    /**
     * User send email action.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function emailAction($id)
    {
        try {
            $user = UserModel::findOrFail($id);
            $job = (new SendEmailReminderJob($user))->onQueue('default');
            $this->dispatch($job);
        } catch (\Exception $e) {
            return self::warningResponse([], $e->getMessage());
        }

        return self::successResponse();
    }
}
