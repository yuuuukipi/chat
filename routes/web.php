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
Route::get('/rooms','RoomsController@index')->name('index');
Route::get('/rooms/create','RoomsController@get_create')->name('create_talk');
Route::post('/rooms/create','RoomsController@post_create')->name('created_talk');
//チャット詳細画面
Route::get('/rooms/{room}', 'RoomsController@show')->where('room', '[0-9]+');
//チャット投稿
Route::post('/rooms/{room}/chats', 'RoomsController@store');
//メンバー一覧表示
Route::get('/rooms/{room}/member', 'RoomsController@member');
//ユーザー画面(他人)
Route::get('/users/{user}', 'UsersController@show');
//ユーザー画面(自分)
Route::get('/mypage', 'UsersController@myshow');
Route::get('/mypage/edit', 'UsersController@edit');
Route::patch('/mypage', 'UsersController@update');

//ルーム編集
Route::get('/rooms/{room}/edit', 'RoomsController@edit');

//チャット投稿削除
Route::delete('/rooms/chats/{chat}', 'RoomsController@destroy');
//トークルーム削除
Route::delete('/rooms/{room}', 'RoomsController@destroy_room');
