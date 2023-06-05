<?php


Route::get('/login', fn() => AuthController::CreateView('login'));
Route::get('/register', fn() => AuthController::CreateView('register'));

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');