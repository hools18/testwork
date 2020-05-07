<?php

use Illuminate\Routing\Router;

/** @var $router Router */

$router->group(['namespace' => 'App\Controllers'], function (Router $router) {

    $router->get('/', function (){
        header("Location: https://testwork.gq/client");
        exit();
    });
    $router->group(['prefix' => 'authors'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'AuthorController@index']);
        $router->get('/getNews', ['name' => 'create', 'uses' => 'AuthorController@getNews']);
    });
    $router->group(['prefix' => 'news'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'NewsController@index']);
        $router->get('/search', ['name' => 'search', 'uses' => 'NewsController@search']);
    });
    $router->group(['prefix' => 'sections'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'SectionController@index']);
        $router->get('/getNews', ['name' => 'show', 'uses' => 'SectionController@getNews']);
    });

    $router->group(['prefix' => 'setting'], function (Router $router) {
        $router->get('/install', ['name' => 'index', 'uses' => 'SettingController@install']);
        $router->get('/drop', ['name' => 'index', 'uses' => 'SettingController@drop']);
    });
});
