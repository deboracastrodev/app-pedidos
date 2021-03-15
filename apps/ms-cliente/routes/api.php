<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Support\Facades\Route;

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

$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    $router->get('me', 'AuthController@me');
    // Matches "/api/register
    $router->post('register', 'AuthController@register');
     // Matches "/api/login
    $router->post('login', 'AuthController@login');
});

$router->group(['prefix' => 'api/v1/user'], function () use ($router) {

    // Matches "/api/v1/user/profile
    $router->get('profile', 'API\v1\UserController@profile');

    // Matches "/api/v1/user/1 
    //get one user by id
    $router->get('{id}', 'API\v1\UserController@singleUser');

    // Matches "/api/v1/user
    $router->get('/', 'API\v1\UserController@allUsers');
});

$router->group([
  'prefix' => 'v1',
  'as' => 'api.', 
  'namespace' => 'API\V1', 
], function () use ($router) {
    $router->get('cliente', 'API\v1\ClienteController@listAll');
}); 