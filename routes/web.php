<?php

use Illuminate\Support\Facades\Cache;

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

$router->group(['prefix' => 'api'], function () use ($router) {

    /**
     * Heroes
     */
    $router->get('heroes/',  ['uses' => 'HeroController@index']);

    $router->get('heroes/{id}', ['uses' => 'HeroController@show']);

    $router->post('heroes', ['uses' => 'HeroController@store']);

    $router->delete('heroes/{id}', ['uses' => 'HeroController@destroy']);

    $router->put('heroes/{id}', ['uses' => 'HeroController@update']);

    /**
     * Powers
     */
    $router->get('powers/',  ['uses' => 'PowerController@index']);


    /**
     * Teams
     */
    $router->get('teams/',  ['uses' => 'TeamController@index']);


    // Flush cache
    $router->get('f', function(){
        Cache::flush();
    });

});
