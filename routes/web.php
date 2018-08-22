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
Route::get('/self/register','Auth\RegisterController@register_form')->name('register.form');
Route::post('/self/check','Auth\RegisterController@register_check')->name('register.check');
Route::post('/self/complete','Auth\RegisterController@register_complete')->name('register.complete.self');
// Route::get('/rooms', ['middleware' => 'auth', 'uses' => 'RoomsController@index']);
//ログイン
// Route::get('/login','Auth\LoginController@login')->name('login');
// Route::get('/signin','Auth\LoginController@signin')->name('signin');
// Route::get('/logout','Auth\LoginController@logout')->name('logout');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//トーク作成
Route::get('/rooms','RoomsController@index')->name('index');
Route::get('/rooms/create','RoomsController@getCreate')->name('create_talk');
Route::post('/rooms/create','RoomsController@postCreate')->name('created_talk');
//チャット詳細画面
Route::get('/rooms/{room}', 'RoomsController@show')->where('room', '[0-9]+');
//チャット投稿
Route::post('/rooms/{room}/chats', 'ChatsController@store');
//メンバー一覧表示
Route::get('/rooms/{room}/member', 'RoomsController@member');
//ユーザー画面(他人)
Route::get('/users/{user}', 'UsersController@show');
//ユーザー画面(自分)
Route::get('/mypage', 'UsersController@myshow');
Route::get('/mypage/edit', 'UsersController@edit');
Route::patch('/mypage', 'UsersController@update');


Route::get('/rooms/test', 'RoomsController@test');


//ルーム編集
Route::get('/rooms/{room}/edit', 'RoomsController@edit');

//チャット投稿削除
Route::delete('/rooms/chats/{chat}', 'ChatsController@destroy');
//トークルーム削除
Route::delete('/rooms/{room}', 'RoomsController@destroyRoom');
//ユーザー削除
Route::delete('/rooms/{room}/users/{user}', 'RoomsController@destroyUser');
//ユーザー追加
Route::post('/rooms/{room}/users/new', 'RoomsController@addUser');

//管理画面　ユーザー一覧
Route::get('/rooms/admin/users', 'AdminController@adminUsers');
//管理画面　ルーム一覧
Route::get('/rooms/admin/rooms', 'AdminController@adminRooms');
//管理画面　投稿一覧
Route::get('/rooms/admin/chats', 'AdminController@adminChats');

//管理画面　ルーム編集
Route::get('/rooms/admin/rooms/edit/{room}', 'AdminController@adminRoomsEdit');
Route::patch('/rooms/admin/rooms/edit/{room}/update', 'AdminController@updateRoom');
//管理画面　ルーム メンバー一覧
Route::get('/rooms/admin/rooms/{room}/member', 'AdminController@adminRoomsMember');

//管理画面　メンバー編集
Route::get('/rooms/admin/users/edit/{user}', 'AdminController@adminUsersEdit');
Route::patch('/rooms/admin/rooms/edit/user/{user}/update', 'AdminController@updateUser');
//管理画面　メンバー削除
Route::delete('/rooms/admin/users/edit/{user}/delete', 'AdminController@adminUsersDestroy');

//管理画面　投稿編集
Route::get('/rooms/admin/chats/edit/{chat}', 'AdminController@adminChatsEdit');
Route::patch('/rooms/admin/chats/edit/{chat}/update', 'AdminController@updateChat');
