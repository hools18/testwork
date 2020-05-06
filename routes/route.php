<?php

use Illuminate\Routing\Router;

/** @var $router Router */

$router->group(['namespace' => 'App\Controllers'], function (Router $router) {
    $router->group(['prefix' => 'authors'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'AuthorController@index']);
        $router->get('/{author_id}', ['name' => 'create', 'uses' => 'AuthorController@show'])->where('author_id', '[0-9]+');
        $router->get('/{author_id}/getNews', ['name' => 'create', 'uses' => 'AuthorController@getNews'])->where('author_id', '[0-9]+');
    });
    $router->group(['prefix' => 'news'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'NewsController@index']);
        $router->get('/{news_id}', ['name' => 'show', 'uses' => 'NewsController@show'])->where('news_id', '[0-9]+');
        $router->get('/search/{search}', ['name' => 'index', 'uses' => 'NewsController@search']);
        $router->get('/search/{search}/section/{section_id}', ['name' => 'index', 'uses' => 'NewsController@search_with_section'])->where('section_id', '[0-9]+');
    });
    $router->group(['prefix' => 'sections'], function (Router $router) {
        $router->get('/', ['name' => 'index', 'uses' => 'SectionController@index']);
        $router->get('/{section_id}', ['name' => 'show', 'uses' => 'SectionController@show'])->where('section_id', '[0-9]+');
        $router->get('/{section_id}/getNews', ['name' => 'show', 'uses' => 'SectionController@getNews'])->where('section_id', '[0-9]+');
    });
});
