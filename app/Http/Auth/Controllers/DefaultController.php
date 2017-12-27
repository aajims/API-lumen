<?php

namespace App\Http\Auth\Controllers;

use App\Traits\ResultsetTrait;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Log;

class DefaultController extends Controller
{
    use ResultsetTrait;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listAction(Request $request)
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

        /** 日志记录 */
        Log::emergency($msg);
        Log::alert($msg);
        Log::critical($msg);
        Log::error($msg);
        Log::warning($msg);
        Log::notice($msg);
        Log::info($msg);
        Log::debug($msg);

        return self::successResponse($array, $msg);
    }
}
