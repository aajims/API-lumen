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
$action = 'App\Http\%s\Controllers\%sController@%sAction';
$app->router->get(
    '/',
    sprintf($action, 'Auth', 'Authenticate', 'home')
);
$app->router->get('/version', function () use ($app) {
    return $app->version();
});
$app->router->addRoute(
    ['GET', 'POST'],
    '/auth/authorize',
    sprintf($action, 'Auth', 'Authenticate', 'authorize')
);
$app->router->post(
    '/user/register',
    sprintf($action, 'User', 'User', 'create')
);

foreach ($routes as $key => $item) {
    $app->router->group($item, function ($router) use ($app, $key) {
        $app->configure($key);

        require __DIR__ . '/../routes/' . $key . '.php';
    });
}
