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

Route::get('/','RoomsController@index')->name('index');
//会員登録
// Route::get('/register','Auth\RegisterController@register_form')->name('register.form');
// Route::post('/check','Auth\RegisterController@register_check')->name('register.check');
// Route::post('/complete','Auth\RegisterController@register_complete')->name('register.complete');
//ログイン
// Route::get('/login','Auth\LoginController@login')->name('login');
// Route::get('/signin','Auth\LoginController@signin')->name('signin');
// Route::get('/logout','Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//トーク作成
Route::get('/create','RoomsController@create')->name('create_talk');
Route::post('/created','RoomsController@created')->name('created_talk');
//チャット詳細画面
Route::get('/chats/{room}', 'RoomsController@show')->where('room', '[0-9]+');
//チャット投稿
Route::post('/rooms/{room}/chats', 'ChatsController@store');
