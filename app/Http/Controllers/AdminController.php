<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
// use App\Room_user;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

  //管理画面　ユーザー一覧
  public function adminUsers(){
    $users = User::orderBy('id')->paginate(20);

    return view('admin.users')->with('users', $users);
  }

  //管理画面　ルーム一覧
  public function adminRooms(){
    $rooms = Room::orderBy('id')->paginate(30);

    return view('admin.rooms')->with('rooms', $rooms);
  }

  //管理画面　投稿一覧
  public function adminChats(){
    $chats = Chat::orderBy('id')->paginate(30);

    return view('admin.chats')->with('chats', $chats);

  }


  /*ユーザー
  管理画面　ユーザー編集
  */
  public function adminUsersEdit(user $user){
    return view('admin.edit.user')->with('user', $user);
  }

  //管理画面　ユーザー削除
  public function adminUsersDestroy(user $user){
    $user->delete();
    return redirect()->action('AdminController@adminUsers', $user->id);
  }

  //管理画面　ユーザー情報更新
  public function updateUser(request $request, User $user){
    $user->name=$request->name;
    $user->email=$request->email;
    $user->save();
    return redirect()->action('AdminController@adminUsersEdit', $user->id);
  }



  //管理画面　ルーム編集
  public function adminRoomsEdit(room $room){
    $delUsers=User::all();
    $delUsers=$room->users;

    $addUsers=User::all();

    return view('admin.edit.room')->with(['room'=>$room,'add_users'=>$addUsers,'del_users'=>$delUsers]);
  }

  //ルーム内容更新
  public function updateRoom(request $request, Room $room){
    $room->name=$request->name;
    $room->create_user=$request->create_user;
    $room->save();
    return redirect()->action('AdminController@adminRoomsEdit', $room->id);
  }


  /*
  管理画面　チャット編集
  */
  public function adminChatsEdit(chat $chat){
    return view('admin.edit.chat')->with('chat', $chat);
  }

  //チャット内容更新
  public function updateChat(request $request, Chat $chat){
    $chat->comment=$request->comment;
    $chat->save();
    return redirect()->action('AdminController@adminChatsEdit', $chat->id);
  }


}
