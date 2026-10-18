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

$router->get('posts', 'PostsController@index');
$router->get('posts/{id}', 'PostsController@show');

$router->get('users', 'UsersController@index');
$router->get('users/{id}', 'UsersController@show');

$router->get('categories', 'CategoriesController@index');
$router->get('categories/{id}', 'CategoriesController@show');

$router->get('comments', 'CommentsController@index');
$router->get('comments/{id}', 'CommentsController@show');

$router->get('tags', 'TagsController@index');
$router->get('tags/{id}', 'TagsController@show');
