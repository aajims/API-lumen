<?php

/*
|--------------------------------------------------------------------------
| All Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$routes = [
    'auth' => [
        'prefix'     => 'auth',
        'namespace'  => 'App\Http\Auth\Controllers',
        'middleware' => 'auth:api',
    ],
    'user' => [
        'prefix'     => 'user',
        'namespace'  => 'App\Http\User\Controllers',
        'middleware' => 'auth:api',
    ],

    'foo' => [
        'prefix'     => 'foo',
        'namespace'  => 'App\Http\Foo\Controllers',
        'middleware' => 'auth:api',
    ],
];
$app->router->get(
    '/',
    'App\Http\Auth\Controllers\DefaultController@listAction'
);
$app->router->get('/version', function () use ($app) {
    return $app->version();
});
$app->router->addRoute(
    ['GET', 'POST'],
    '/auth/authorize',
    'App\Http\Auth\Controllers\AuthenticateController@authorizeAction'
);
$app->router->post(
    '/user/register',
    'App\Http\User\Controllers\UserController@createAction'
);

foreach ($routes as $key => $item) {
    $app->router->group($item, function ($router) use ($app, $key) {
        $app->configure($key);

        require __DIR__ . '/../routes/' . $key . '.php';
    });
}
