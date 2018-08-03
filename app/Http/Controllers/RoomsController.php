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
    /*
    //課題！
    $list = [];
    for ($i=0;$i<100;$i++) {
        $list[]=mt_rand(1,10);
    }
    var_dump($list);
    var_dump('-------');

    $answer = [];
    for ($i=0; $i <99 ; $i++) {
      // $ans_len=count($answer);
      if ($i==0) {
        // $ans_len=$ans_len+1;
        // １回目の処理
          if($list[0]<$list[1]){
            $answer[0]=$list[0];
            $answer[1]=$list[1];
          }else {
            $answer[0]=$list[1];
            $answer[1]=$list[0];
          }

        }else{
          //2回目
          for ($a=0; $a<$i+1; $a++) {
            if ($answer[$a]>$list[$i+1]) {
              for ($n=$i; $n >= $a; $n--) {
                $answer[$n+1]=$answer[$n];
              }
              $answer[$a]=$list[$i+1];
              $a=$i+1;
            }else{
              $answer[$i+1]=$list[$i+1];
          }
        }

      }
    }
    dd($answer);
    // 課題ここまで
    */

    // foreach($room->room_users as $data){
    //   var_dump($data->user->name);
    // }
    // dd($room);
    //
    // $users=User::select(DB::raw('id,name'))
    // ->where('id','<>','room.room_users.user_id')
    // ->get();

// dd($room->id);
    // $users=Room::select(DB::raw('users.id,users.name'))
    // ->leftJoin('room_users', 'rooms.id', '=', 'room_users.room_id')
    // ->leftJoin('users', 'room_users.user_id', '=', 'users.id')
    // ->where('rooms.id','<>',$room->id)
    // ->get();
    // dd($room->id);





    $users=User::select(DB::raw('users.id,users.name'))
    ->Join('room_users', 'room_users.user_id', '=', 'users.id')
    // ->leftJoin('rooms', 'rooms.id', '=', 'room_users.room_id')
    ->where('room_users.room_id','=',$room->id)
    // ->and('room_users.user_id','<>','users.id')
    //->where('room_users.room_id','!=',$room->id)
    ->get();
    // dd($users);

    $user2=User::select('id')
    ->where($users->id,'<>','id')
    ->get();

    foreach ($user as $key => $value) {
      foreach ($user2 as $key => $value) {
        if($users)
      }
    }


    $user2=User::select('id')
    ->where($users->id,'<>','id')
    ->get();
    // dd($user2);

    dd($user2);

    return view('rooms.edit')->with(['room'=>$room,'users'=>$users]);
  }

  public function destroy(chat $chat) {

  // dd($chat->id);
  $chat->delete();
  return redirect()->action('RoomsController@show', $chat->room_id);
  }

  public function destroyRoom(room $room) {
  $room->delete();
  return redirect('/rooms');
  }


}
