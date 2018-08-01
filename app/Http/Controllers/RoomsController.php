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
  //   $rooms = Room::join('rooms', 'rooms.id', '=', 'chats.room_id')
  //   ->select(DB::raw('room_id, max(id) as max_id'))
  //   ->groupBy('room_id')
  //   ->get();
//
// latest()->get();
//ここ

/*
$rooms = Room::select(DB::raw('room_id, rooms.name as name, max(chats.id) as max_id'))
  ->join('chats', 'chats.room_id', '=', 'rooms.id')
  ->groupBy('room_id')
  ->orderBy('rooms.created_at')
  ->get();
dd($rooms);
*/


    $rooms = Room::with(['room_users'])
      ->select(DB::raw('rooms.id as id, name, max(chats.id) as max_id, rooms.created_at'))
      ->leftJoin('chats', 'chats.room_id', '=', 'rooms.id')
      ->groupBy('rooms.id')
      ->orderBy('rooms.created_at', 'desc')
      ->get();


      // dd($rooms);
      // dd($rooms);


/*
    $rooms = Room::join('chats', 'chats.room_id', '=', 'rooms.id')
      //->select(DB::raw('room_id, max(rooms.id) as max_id'))
      // ->groupBy('room_id')
      ->get();
      dd($rooms);
foreach ($chats as $chat) {
  dd($chat->max_id);
}
*/

//????????
// $rooms = Room::latest()->get()
// ->join('chats', 'rooms.id', '=', 'chats.room_id');
// dd($rooms);
//
// $chat= DB::table('chats')
//      ->select(DB::raw('room_id, max(id)'))
//      ->groupBy('room_id')
//      ->get();
//      dd($chat->room_id->where('room_id','=','max(id)->15'));

   // $max_chat = Chat::latest()->first();
   // $max_id='#a'.$max_chat->id;
   //
   //
   //
   //    foreach ($chats as $chat) {
   //      dd($chat->max_id);
   //    }
   //    dd($chat);
   //
   //  $max_chat = Chat::latest()->first();
   //  $max_id='#a'.$max_chat->id;
    // dd($max_id);

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
    // dd($room);
    // dd($latest_id->id);
    // dd($latest_id->ToArray());
    return view('chats.show')->with('room', $room);
    // return view('chats.show', [$room, $latest_id->id])->with('room', $room);
    // return redirect('/chats/',['$room->id','#a.$latest_id->id'])->with('room', $room);
    //return redirect('/chats_detail/1#a30');
    // return redirect()->action('RoomsController@show2', [$room]);
  }

  // public function show2(Room $room){
  //   exit;
  //   //TODO room_id　chatsテーブルに紐ずいているroom_idを取得、最新の一件
  //   // $latest_id=Chat::latest()->first()->where($room_id = $a);
  //   $latest_id=Chat::where('room_id','=',$room->id)->latest()->first();
  //   $room->latest_id=$latest_id->id;
  //   // dd($room);
  //   // dd($latest_id->id);
  //   // dd($latest_id->ToArray());
  //   // return view('chats.show')->with('room', $room);
  //   return view('/chats/'.$room->id)->with('room', $room);
  // }
}
