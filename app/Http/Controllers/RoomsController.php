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
    $users = User::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(10);
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
  public function show(Room $room){

      $latest_id=Chat::latest()->first();
      $room->latest_id=$latest_id->id+1;
      // dd($room->latest_id);

    return view('rooms.show')->with('room', $room);
  }

  //チャット投稿
  public function store(Request $request, Room $room){
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
    return view('rooms.edit')->with('room', $room);
  }
}
