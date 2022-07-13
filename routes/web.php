<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use app\Http\Controllers\UserController;

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

$router->group(['prefix' => 'api'], function () use ($router) {

    /**
     * Users
     */
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->post('/', ['uses' => 'UserController@store']);
        $router->get('/{id}', ['uses' => 'UserController@show']);
        $router->put('/{id}', ['uses' => 'UserController@update']);
        $router->delete('/{id}', ['uses' => 'UserController@destroy']);
    });

    /**
     * Vehicles
     */
    $router->group(['prefix' => 'vehicles'], function () use ($router) {
        $router->get('/', ['uses' => 'VehicleController@index']);
        $router->post('/', ['uses' => 'VehicleController@store']);
        $router->get('/{id}', ['uses' => 'VehicleController@show']);
        $router->put('/{id}', ['uses' => 'VehicleController@update']);
        $router->delete('/{id}', ['uses' => 'VehicleController@destroy']);
        $router->put('/set_owner/{vehicleId}', ['uses' => 'VehicleController@setOwner']);
        $router->put('/release/{vehicleId}', ['uses' => 'VehicleController@release']);
    });
});
