<?php

include 'middlewares.php';

Route::setMiddlewares([$guest, $auth]);

Route::get('/', fn() => Redirect::to('/login'));
Route::get('/login', 'AuthController@loginView', [$guest]);
Route::get('/register', 'AuthController@registerView', [$guest]);
Route::post('/login', 'AuthController@login', [$guest]);
Route::post('/register', 'AuthController@register', [$guest]);


Route::get('/profile', 'ProfileController@index', [$auth]);
Route::get('/logout', 'AuthController@logout', [$auth]);


Route::notFound(fn() => Redirect::to('/'));


