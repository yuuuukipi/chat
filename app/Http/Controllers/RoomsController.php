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

class RoomsController extends Controller
{
  public function index(){

  //test
    // if(
    $rooms = Room::with(['room_users'])
      ->select(DB::raw('rooms.id as id, name, max(chats.id) as max_id, rooms.created_at'))
      ->leftJoin('chats', 'chats.room_id', '=', 'rooms.id')
      ->groupBy('rooms.id')
      ->orderBy('rooms.created_at', 'desc')
      ->get();

    return view('rooms.index')->with('rooms', $rooms);
  }

  //トークルーム作成
  public function get_create(){
    // dd(User::orderBy('updated_at', 'desc'));
    $users = User::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(20);
    return view('rooms.create')->with('users', $users);
  }

  //トークルーム保存
  public function post_create(Request $request){
    //roomsテーブル更新
    $room = new Room();
    $room->name = $request->name;
    $room->create_user = Auth::user()->name;
    $room->save();

    //room_userテーブル更新
    foreach ($request['member'] as $key => $member_id) {
      $room_user = new Room_user();
      $room_user->room_id=$room->id;
      $room_user->user_id=$member_id;
      $room_user->save();
    }
    $room_user = new Room_user();
    $room_user->room_id=$room->id;
    $room_user->user_id=Auth::user()->id;
    $room_user->save();

    return redirect('/rooms/');
  }

  //チャット画面
  public function show(Request $request, Room $room){

      $latest_id=Chat::latest()->first();
      if($latest_id<>null){
      $room->latest_id=$latest_id->id+1;
      }
      // dd($room->latest_id);
      $token = md5(uniqid(rand(), true));
      $request->session()->put('token', $token);

    return view('rooms.show')->with('room', $room);
  }

  //チャット投稿
  public function store(Request $request, Room $room){
      // $post_token=$request->get('token');
      //
      // if($request->session()->get('token') !== $post_token){
      //     return redirect('/');
      // }


  $this->validate($request, [
    'comment' => 'required'
  ]);
  // dd($request->comment);
  $chat=new Chat([
      'room_id' => $room->id,
      'comment' => $request->comment,
      'user_id' => Auth::user()->id]);
  // dd($room);
  $chat->save();

  return redirect()->action('RoomsController@show', $room);
}

  //メンバー一覧
  public function member(Room $room){
    return view('rooms.member')->with('room', $room);
  }

  //ルーム編集
  public function edit(Room $room){
    // dd($room->users()->get());
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
    // dd($users);

    return view('rooms.edit')->with(['room'=>$room,'add_users'=>$add_users,'del_users'=>$del_users]);
  }

  //投稿削除
  public function destroy(chat $chat) {

    // dd($chat->id);
    $chat->delete();
    if('1'==Auth::user()->admin_flag){
      return redirect()->action('AdminController@admin_chats', $chat->id);
    }else{
      return redirect()->action('RoomsController@show', $chat->room_id);
    }
  }

  //ルーム削除
  public function destroyRoom(room $room) {
    $room->delete();
    if('1'==Auth::user()->admin_flag){
      return redirect()->action('AdminController@admin_rooms', $room->id);
    }else{
      return redirect('/rooms');
    }
  }

  //ルームのメンバー削除
  public function destroyUser(room $room,request $request) {
    $roomUser=Room_user::select(DB::raw('id'))
        ->where('room_id','=',$room->id)
        ->where('user_id','=',$request->user)
        ->first();
    $roomUser->delete();
    if('1'==Auth::user()->admin_flag){
      return redirect()->action('AdminController@admin_rooms_edit', $room->id);
    }else{
      return redirect()->action('RoomsController@edit', $room->id);
    }
  }

  //ルームのメンバー追加
  public function add_user(room $room, request $request){
    foreach ($request['member'] as $key => $member_id) {
      $room_user = new Room_user();
      $room_user->room_id=$room->id;
      $room_user->user_id=$member_id;
      $room_user->save();
    }

    if('1'==Auth::user()->admin_flag){
      return redirect()->action('AdminController@admin_rooms_edit', $room->id);
    }else{
      return redirect()->action('RoomsController@edit', $room->id);
    }
  }
}
