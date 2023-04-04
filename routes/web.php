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

$router->group(['prefix' => 'api'], function ($router) {
    $router->group(['prefix' => 'user'], function ($router) {
        $router->post('sign-in', 'AuthController@login');
        $router->post('register', 'AuthController@registration');
        $router->get('send-recover', 'AuthController@sendRecover');
        $router->post('recover-password', 'AuthController@recover');
        $router->group(['prefix' => 'companies', 'middleware' => 'auth:api'], function ($router){
            $router->post('','CompanyController@create');
            $router->get('','CompanyController@index');

        });
    });
});


