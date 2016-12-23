<?php

use \Phroute\Phroute\RouteCollector;

/** @var RouteCollector $router */

$router->group(['prefix' => 'admin', 'before' => 'admin'], function (RouteCollector $router) {

    $router->get('/', 'Admin\MainController@index');

    $router->get('/categories', 'Admin\CategoryController@index');
    $router->post('/categories', 'Admin\CategoryController@store');
    $router->get(['/categories/{id:\d+}/destroy', 'admin.categories.destroy'],
        'Admin\CategoryController@destroy');

    $router->get('/news', 'Admin\NewsController@index');
    $router->post('/news', 'Admin\NewsController@store');

    $router->get('/users', 'Admin\UserController@index');
    $router->post('/users', 'Admin\UserController@store');
    $router->get(['/users/{id:\d+}/edit', 'admin.users.edit'], 'Admin\UserController@edit');
    $router->get(['/users/{id:\d+}/destroy', 'admin.users.destroy'], 'Admin\UserController@destroy');

});

$router->get('/', 'MainController@index');

$router->get('/categories', 'MainController@categories');
$router->get(['/category/{id:\d+}', 'category'], 'MainController@category');

$router->get('/contacts', 'MainController@contacts');
$router->post('/feedback', 'FeedbackController@submit');

$router->get(['/news/{id:\d+}', 'news.show'], 'NewsController@show');

$router->get('/register', 'Auth\RegisterController@index');
$router->post('/register', 'Auth\RegisterController@register');

$router->post('/login', 'Auth\LoginController@login');