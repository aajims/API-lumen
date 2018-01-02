<?php

namespace App\Http\Auth\Controllers;

use App\Support\Tip;
use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateController extends Controller
{
    use ResultsetTrait;

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
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
     * Home page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeAction(Request $request)
    {
        $array = [
            'acceptableContentTypes' => $request->getAcceptableContentTypes(),
            'basePath'               => $request->getBasePath(),
            'charsets'               => $request->getCharsets(),
            'clientIp'               => $request->getClientIp(),
            'clientIps'              => $request->getClientIps(),
            'contentType'            => $request->getContentType(),
            'defaultLocale'          => $request->getDefaultLocale(),
            'encodings'              => $request->getEncodings(),
            'etags'                  => $request->getETags(),
            'host'                   => $request->getHost(),
            'httpHost'               => $request->getHttpHost(),
            'languages'              => $request->getLanguages(),
            'locale'                 => $request->getLocale(),
            'method'                 => $request->getMethod(),
            'pathInfo'               => $request->getPathInfo(),
            'port'                   => $request->getPort(),
            'protocolVersion'        => $request->getProtocolVersion(),
            'queryString'            => $request->getQueryString(),
            'realMethod'             => $request->getRealMethod(),
            'requestUri'             => $request->getRequestUri(),
            'routeResolver'          => $request->getRouteResolver(),
            'scheme'                 => $request->getScheme(),
            'schemeAndHttpHost'      => $request->getSchemeAndHttpHost(),
            'scriptName'             => $request->getScriptName(),
            'session'                => $request->getSession(),
            'uri'                    => $request->getUri(),
            'user'                   => $request->getUser(),
            'userAgent'              => $request->userAgent(),
            'userInfo'               => $request->getUserInfo(),
            'userResolver'           => $request->getUserResolver(),
        ];
        $msg = '🌹 ^_^ 欢迎访问 Lumen API : )';
        ksort($array);

        return self::successResponse($array, $msg);
    }

    /**
     * User authorize token.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authorizeAction(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
            $credentials = $request->only('email', 'password');
            $token = $this->jwtAuth->attempt($credentials);

            if ($token === false) {
                return self::successResponse(
                    [],
                    'The user not found.',
                    Tip::AUTH_USER_NOT_FOUND
                );
            }
        } catch (TokenExpiredException $e) {
            return self::successResponse(
                [],
                $e->getMessage(),
                Tip::AUTH_TOKEN_EXPIRED
            );
        } catch (TokenInvalidException $e) {
            return self::successResponse(
                [],
                $e->getMessage(),
                Tip::AUTH_TOKEN_INVALID
            );
        } catch (JWTException $e) {
            return self::successResponse(
                [],
                $e->getMessage(),
                Tip::AUTH_JWT_INVALID
            );
        }

        return $this->responseWithToken($token);
    }

    /**
     * User information.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function userAction()
    {
        $this->jwtAuth->parseToken();
        $user = $this->jwtAuth->user()->toArray();

        return self::successResponse($user);
    }

    /**
     * User access token information.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function infoAction()
    {
        $this->jwtAuth->parseToken();
        $array = $this->jwtAuth->getPayload()->toArray();
        $array['token'] = $this->jwtAuth->getToken()->get();
        $array['uid'] = $this->jwtAuth->user()->getJWTIdentifier();

        return self::successResponse($array);
    }

    /**
     * User refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Tymon\JWTAuth\Exceptions\JWTException
     */
    public function refreshAction()
    {
        $this->jwtAuth->parseToken();
        $token = $this->jwtAuth->refresh();

        return $this->responseWithToken($token);
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

    /**
     * Response with token.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseWithToken($token)
    {
        $array = [
            'token'  => $token,
            'type'   => 'bearer',
            'expire' => $this->guard()->factory()->getTTL() * 60,
            'uid'    => $this->guard()->user()->getAuthIdentifier(),
        ];

        return self::successResponse($array, 'The user token.');
    }
}
