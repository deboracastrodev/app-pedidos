<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
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

$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    $router->get('me', 'AuthController@me');
});

// API route group
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');
     // Matches "/api/login
    $router->post('login', 'AuthController@login');

    // Matches "/api/profile
    $router->get('profile', 'APIv1\UserController@profile');

    // Matches "/api/users/1 
    //get one user by id
    $router->get('users/{id}', 'APIv1\UserController@singleUser');

    // Matches "/api/users
    $router->get('users', 'APIv1\UserController@allUsers');
});