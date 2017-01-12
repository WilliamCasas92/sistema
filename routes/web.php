<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Ruta Inicio
Route::get('/', function () {
    return view('welcome');
});

//Ruta Home
Route::get('home', function () {
    return view('home');
});
//Rutas Usuarios
Route::resource('users', 'UserController');
//Rutas Google
Route::get('social/google', 'SocialController@getSocialAuth');
Route::get('social/callback/google', 'SocialController@getSocialAuthCallback');

//Rutas LogIn LogOut
Auth::routes();

Route::get('/home', 'HomeController@index');

//Rutas TipoProceso
Route::resource('tipoproceso', 'TipoProcesoController');
