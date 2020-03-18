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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/todo', 'TodoController@index'); //menampilkan semua data
$router->get('/todo/{id}', 'TodoController@show'); //menampilkan sebuah data
$router->post('/addtodo', 'TodoController@create'); //menambahkan data
$router->post('/updatetodo/{id}', 'TodoController@update'); //melakukan update data
$router->delete('/deletetodo/{id}', 'TodoController@delete'); //menghapus sebuah data

$router->post('/register', 'UserController@register'); //register
