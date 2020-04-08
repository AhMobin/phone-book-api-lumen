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

$router->group(['prefix'=>'api'], function ($router){
   $router->get('/user','UserController@read');
   $router->post('/user','UserController@store');
   $router->delete('/delete/{id}','UserController@destroy');

   $router->post('/login','Auth\LoginController@Login');

//   authentication testing.........
//   $router->post('/token',['middleware'=>'auth','uses'=>'Auth\LoginController@TokenTest']);

    $router->post('/phonebook',['middleware'=>'auth','uses'=>'PhonebookController@store']);
    $router->post('/show',['middleware'=>'auth','uses'=>'PhonebookController@show']);
    $router->post('/index',['middleware'=>'auth','uses'=>'PhonebookController@index']);
    $router->put('/update',['middleware'=>'auth','uses'=>'PhonebookController@update']);
    $router->delete('/delete',['middleware'=>'auth','uses'=>'PhonebookController@destroy']);

});
