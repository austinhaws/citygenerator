<?php

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

// prod: prod strips because of .htaccess and other insanity so that it's just /
$baseRoute = '/';
// dev?
// $baseRoute = 'citygenerator/';

// citygen
$router->group(['namespace' => 'CityGen'], function ($router) use($baseRoute) {
    $router->get($baseRoute . 'lists', 'CityGenController@getLists');
    $router->post($baseRoute . 'generate', 'CityGenController@generate');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

