<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
use App\Room_user;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoomsController extends Controller
{
  public function index(){
    $rooms = Room::latest()->get();
    // dd($room->all());
    return view('rooms.index')->with('rooms', $rooms);
  }

  //トークルーム作成
  public function create(){
    // dd(User::orderBy('updated_at', 'desc'));
    $users = User::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(10);
    return view('rooms.create')->with('users', $users);
  }

  //トークルーム保存
  public function created(Request $request){
    // dd(Auth::user()->name);
     // dump($request->all());
    //roomsテーブル更新
    $room = new Room();
    $room->name = $request->name;
    $room->create_user = Auth::user()->name;
    $room->save();

    // dd($room->id);

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

    return redirect('/');
  }

  //チャット画面
  public function show(Room $room){
    //TODO room_id　chatsテーブルに紐ずいているroom_idを取得、最新の一件
    // $latest_id=Chat::latest()->first()->where($room_id = $a);
    // $latest_id=Chat::where('room_id','=',$room->id)->latest()->first();
    // $room->latest_id=$latest_id->id;
    // // dd($room);
    return view('chats.show')->with('room', $room);
  }
}
