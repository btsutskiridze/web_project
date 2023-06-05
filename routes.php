<?php


Route::get('/login', fn() => AuthController::view('login'));
Route::get('/register', fn() => AuthController::view('register'));

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');