<?php

namespace App\Http\Bar\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateController extends BarController
{
    /** @var \Tymon\JWTAuth\JWTAuth */
    protected $jwtAuth;

    /**
     * AuthenticateController constructor.
     *
     * @param \Tymon\JWTAuth\JWTAuth $jwtAuth
     */
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * Login action.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAction(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            $credentials = $request->only('email', 'password');
            $token = $this->jwtAuth->attempt($credentials);

            if ( ! $token) {
                return response()->json(['msg' => 'User not found.'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['msg' => $e->getMessage()], 200);
        } catch (TokenInvalidException $e) {
            return response()->json(['msg' => $e->getMessage()], 200);
        } catch (JWTException $e) {
            return response()->json(['msg' => $e->getMessage()], 200);
        }

        return response()->json(compact('token'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'token'  => $token,
            'type'   => 'bearer',
            'expire' => $this->guard(),
        ]);
    }
}
