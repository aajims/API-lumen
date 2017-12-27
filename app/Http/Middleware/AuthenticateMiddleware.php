<?php

namespace App\Http\Middleware;

use App\Support\Tip;
use App\Traits\ResultsetTrait;
use Closure;
use Illuminate\Contracts\Auth\Factory;

class AuthenticateMiddleware
{
    use ResultsetTrait;

    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $factory;

    /**
     * AuthenticateMiddleware constructor.
     *
     * @param \Illuminate\Contracts\Auth\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->factory->guard($guard)->guest()) {
            return self::successResponse(
                [],
                'Unauthorized',
                Tip::AUTH_UNAUTHORIZED,
                401
            );
        }

        return $next($request);
    }
}
