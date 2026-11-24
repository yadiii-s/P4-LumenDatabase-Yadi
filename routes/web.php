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

$router->get('/posts', 'PostsController@index');
$router->post('/posts', 'PostsController@store');
$router->get('/post/{id}', 'PostsController@show');
$router->put('/post/{id}', 'PostsController@update');
$router->delete('/post/{id}', 'PostsController@destroy');

$router->get('users', 'UsersController@index');
$router->get('users/{id}', 'UsersController@show');

$router->get('categories', 'CategoriesController@index');
$router->get('categories/{id}', 'CategoriesController@show');

$router->get('comments', 'CommentsController@index');
$router->get('comments/{id}', 'CommentsController@show');

$router->get('tags', 'TagsController@index');
$router->get('tags/{id}', 'TagsController@show');

$router->get('/students', 'StudentsController@index');
$router->post('/students', 'StudentsController@store');
$router->get('/student/{id}', 'StudentsController@show');
$router->put('/student/{id}', 'StudentsController@update');
$router->delete('/student/{id}', 'StudentsController@destroy');
