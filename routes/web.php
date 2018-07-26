<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','RoomsController@index');
Route::get('/register','Auth\RegisterController@register_form')->name('register.form');
Route::post('/check','Auth\RegisterController@register_check')->name('register.check');
