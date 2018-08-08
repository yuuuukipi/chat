<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
use App\Room_user;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

  //管理画面　ユーザー一覧
  public function admin_users(){
    $users = User::orderBy('id')->paginate(20);

    return view('admin.users')->with('users', $users);

  }
  //管理画面　ルーム一覧
  public function admin_rooms(){
    $rooms = Room::orderBy('id')->paginate(30);
    // $chats = Chat::select('chats.updated_at')
    //     ->leftJoin('rooms','chats.room_id','=','rooms.id')
    //     ->groupBy('rooms.id')
    //     ->get();
    //
    // dd($chats);


    return view('admin.rooms')->with('rooms', $rooms);
  }

  //管理画面　投稿一覧
  public function admin_chats(){
    $chats = Chat::orderBy('id')->paginate(30);

    return view('admin.chats')->with('chats', $chats);

  }


  /*ユーザー
  管理画面　ユーザー編集
  */
  public function admin_users_edit(user $user){
    return view('admin.edit.user')->with('user', $user);
  }

  //管理画面　ユーザー削除
  public function admin_users_destroy(user $user){
    $user->delete();
    return redirect()->action('AdminController@admin_users', $user->id);
  }

  //管理画面　ユーザー情報更新
  public function update_user(request $request, User $user){
    $user->name=$request->name;
    $user->email=$request->email;
    $user->save();
    return redirect()->action('AdminController@admin_users_edit', $user->id);
  }



  //管理画面　ルーム編集
  public function admin_rooms_edit(room $room){

    $del_users=User::select(DB::raw('*'))
    ->whereIn(DB::raw('users.id'),function($query) use($room)
    {
      $query->select(DB::raw('users.id'))
            ->from('users')
            ->join('room_users as ru', 'ru.user_id', '=', 'users.id')
            ->where('ru.room_id','=',$room->id);
    })
    ->get();

    $add_users=User::select(DB::raw('*'))
    ->whereNotIn(DB::raw('users.id'),function($query) use($room)
    {
      $query->select(DB::raw('users.id'))
            ->from('users')
            ->join('room_users as ru', 'ru.user_id', '=', 'users.id')
            ->where('ru.room_id','=',$room->id);
    })
    ->get();

      return view('admin.edit.room')->with(['room'=>$room,'add_users'=>$add_users,'del_users'=>$del_users]);
  }

  //ルーム内容更新
  public function update_room(request $request, Room $room){
    // dd(Auth::user()->name);
    $room->name=$request->name;
    $room->create_user=$request->create_user;
    $room->save();
    return redirect()->action('AdminController@admin_rooms_edit', $room->id);
  }


  // //管理画面　投稿一覧
  // public function admin_chats(){
  //   $chats = Chat::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(30);
  //
  //   return view('admin.chats')->with('chats', $chats);
  //
  // }

  /*
  管理画面　チャット編集
  */
  public function admin_chats_edit(chat $chat){
    return view('admin.edit.chat')->with('chat', $chat);
  }
  //チャット内容更新
  public function update_chat(request $request, Chat $chat){
    $chat->comment=$request->comment;
    $chat->save();
    return redirect()->action('AdminController@admin_chats_edit', $chat->id);
  }


}
