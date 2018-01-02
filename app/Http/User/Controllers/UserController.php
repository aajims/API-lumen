<?php

namespace App\Http\User\Controllers;

use App\Events\SendEmailEvent;
use App\Models\User\UserModel;
use App\Traits\ResultsetTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class UserController extends AbstractController
{
    use ResultsetTrait;

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
        $user = $object->toArray();

        return self::successResponse($user);
    }
}
