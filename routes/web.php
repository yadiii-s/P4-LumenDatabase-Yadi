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

// Authentication Routes
$router->group(['prefix' => 'auth'], function () use ($router) {
    // Matches "/auth/register"
    $router->post('/register', 'AuthController@register');
    // Matches "/auth/login"
    $router->post('/login', 'AuthController@login');
    // Matches "/auth/logout"
    $router->delete('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);
    // Matches "/auth/me"
    $router->get('/me', ['middleware' => 'auth', 'uses' => 'AuthController@me']);
});

// Post Routes (Protected by Authentication Middleware)
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/posts', 'PostsController@index');
    $router->post('/posts', 'PostsController@store');
    $router->get('/post/{id}', 'PostsController@show');
    $router->put('/post/{id}', 'PostsController@update');
    $router->delete('/post/{id}', 'PostsController@destroy');
});

// Tantangan Modul: REST CRUD Berotentikasi (Products)
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/products', 'ProductsController@index');
    $router->post('/products', 'ProductsController@store');
    $router->get('/product/{id}', 'ProductsController@show');
    $router->put('/product/{id}', 'ProductsController@update');
    $router->delete('/product/{id}', 'ProductsController@destroy');
});

// Resource routes dari praktikum sebelumnya
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
