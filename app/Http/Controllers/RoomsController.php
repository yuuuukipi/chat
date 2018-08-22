<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\MemberRequest;

class RoomsController extends Controller
{
  //トップ画面
  public function index(){
      $rooms = Room::all(); //ルーム全件取得
      foreach($rooms as $room) {
          $room->chats; //1. ルームに含まれるチャット一覧(配列)
          $room->chats()->count(); // 2. ルーム内のチャットカウント
      }

      return view('rooms.index')->with('rooms', $rooms);
  }

  //トークルーム作成
  public function getCreate(Request $request){
      $users = User::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(20);
      $token = md5(uniqid(rand(), true));
      $request->session()->put('token', $token);

      return view('rooms.create')->with(['users'=>$users, 'token'=>$token]);
  }

  //トークルーム保存
  public function postCreate(RoomRequest $request){
      $postToken=$request->get('token');

      if($request->session()->get('token') !== $postToken){
        $request->session()->forget('token');
        return redirect('/rooms');
      }
      $request->session()->forget('token');

      //roomsテーブル更新
      $room = new Room();
      $room->name = $request->roomname;
      $room->create_user = Auth::user()->name;
      $room->save();

      //中間テーブル更新
      foreach ($request->member as $key => $user_id) {
        $room->users()->attach($user_id);
      }
      $room->users()->attach(Auth::user()->id);

      return redirect('/rooms/');
  }

  //チャット画面
  public function show(Request $request, Room $room){
      $token = md5(uniqid(rand(), true));
      $request->session()->put('token', $token);

      return view('rooms.show')->with(['room'=>$room, 'token'=>$token]);
  }

  //メンバー一覧
  public function member(Room $room){
      return view('rooms.member')->with('room', $room);
  }

  //ルーム編集
  public function edit(Room $room){

      $delUsers=User::all();
      $delUsers=$room->users;

      $addUsers=User::all();

      return view('rooms.edit')->with(['room'=>$room,'addUsers'=>$addUsers,'delUsers'=>$delUsers]);
  }

  //ルーム削除
  public function destroyRoom(room $room) {
      $room->delete();
      if('1'==Auth::user()->admin_flag){
        return redirect()->action('AdminController@adminRooms', $room->id);
      }else{
        return redirect('/rooms');
      }
  }

  //ルームのメンバー削除
  public function destroyUser(room $room,request $request) {
      $room->users()->detach($request->user);

      if('1'==Auth::user()->admin_flag){
        return redirect()->action('AdminController@adminRoomsEdit', $room->id);
      }else{
        return redirect()->action('RoomsController@edit', $room->id);
      }
  }

  //ルームのメンバー追加
  public function addUser(MemberRequest $request, room $room){
      foreach ($request->member as $key => $user_id) {
        $room->users()->attach($user_id);
      }

      if('1'==Auth::user()->admin_flag){
        return redirect()->action('AdminController@adminRoomsEdit', $room->id);
      }else{
        return redirect()->action('RoomsController@edit', $room->id);
      }
  }

  //Ajax用
  public function test(request $request)
  {
      $chat = Chat::select(DB::raw('*'))
          ->where('room_id','=',$request->id)
          ->where('created_at','>',$request->date)
          ->get();

      // $chat = Chat::all();
      // foreach($chats as $chat) {
      //     $room->chats; //1. ルームに含まれるチャット一覧(配列)
      //     $room->chats()->count(); // 2. ルーム内のチャットカウント
      //    //...etc
      //     //Modelクラスのメソッドは、括弧をつけると実行結果、つけないとクエリ情報を含む実行前のオブジェクトを取得する。
      // }

      $user = User::all();

      return array($chat,$user);
  }
}
