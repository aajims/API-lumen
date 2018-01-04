<?php

namespace App\Exceptions;

use App\Support\Tip;
use App\Traits\ResultsetTrait;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ResultsetTrait;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport
        = [
            AuthorizationException::class,
            HttpException::class,
            ModelNotFoundException::class,
            ValidationException::class,
        ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     * @throws \Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($request->all('debug') && (int)$request->get('debug') > 0) {
            return parent::render($request, $e);
        }

        if ($result = self::withCustomJsonResponse($e)) {
            return self::warningResponse(
                $result['info'],
                'NO',
                Tip::FAILED,
                $result['status']
            );
        }
        if ($result = self::withLumenJsonResponse($e)) {
            return self::warningResponse(
                $result['info'],
                'NO',
                Tip::FAILED,
                $result['status']
            );
        }

        return parent::render($request, $e);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    private static function withCustomJsonResponse(Exception $e)
    {
        return [];
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    private static function withLumenJsonResponse(Exception $e)
    {
        $status = 404;
        switch ($e) {
            case $e instanceof HttpResponseException:
                $status = 400;
                break;
            case $e instanceof AuthenticationException:
                $e = new NotFoundHttpException($e->getMessage(), $e);
                $status = 403;
                break;
            case $e instanceof ModelNotFoundException:
                break;
            case $e instanceof ValidationException:
                $status = 400;
                break;
            default:
                break;
        }
        $info = self::getExceptionInfo($e);

        return ['info' => $info, 'status' => $status];
    }

    /**
     * Get exception information.
     *
     * @param \Exception $e
     *
     * @return array
     */
    private static function getExceptionInfo(Exception $e)
    {
        if (env('APP_DEBUG')) {
            $info = [
                'code'          => $e->getCode(),
                'line'          => $e->getLine(),
                'file'          => $e->getFile(),
                'message'       => $e->getMessage(),
                'trace'         => $e->getTrace(),
                'traceAsString' => $e->getTraceAsString(),
                'previous'      => $e->getPrevious(),
                'exception'     => get_class($e),
            ];
        } else {
            $info = [
                'code'    => $e->getCode(),
                'file'    => $e->getFile(),
                'message' => $e->getMessage(),
            ];
        }

        return $info;
    }
}
