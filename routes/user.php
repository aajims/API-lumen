<?php

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

/*
|--------------------------------------------------------------------------
| User Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('list', 'UserController@listAction');
$router->get('email/{id:[0-9]+}', 'UserController@emailAction');
$router->get('push', 'UserController@pushAction');
$router->get('redis', 'UserController@redisAction');
