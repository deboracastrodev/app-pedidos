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


$router->group([
    'prefix' => 'v1',
    'as' => 'api.', 
    'namespace' => 'API\v1'
], function () use ($router) {
    $router->get('cliente', 'ClienteController@listAll');
    $router->post('cliente', 'ClienteController@cadastrar');
    $router->get('cliente/{id}', ['middleware' => 'authapi'], 'ClienteController@getById');
    $router->post('cliente/login', 'ClienteController@login');
}); 

// $router->group(['prefix' => ''], function ($router) 
// {
//     $router->get('me', 'AuthController@me');
//     $router->post('register', 'AuthController@register');
//     $router->post('login', 'AuthController@login');
// });

// $router->group(['middleware' => 'auth', 'prefix' => 'api/v1/user'], function () use ($router) {

//     $router->get('profile', 'API\UserController@profile');
//     $router->get('{id}', 'API\UserController@singleUser');
//     $router->get('/', 'API\UserController@allUsers');
// });