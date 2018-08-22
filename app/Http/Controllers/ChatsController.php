<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
use App\Room_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChatRequest;

class ChatsController extends Controller
{

  //チャット投稿
  public function store(ChatRequest $request, Room $room){

      $postToken=$request->get('token');

      if($request->session()->get('token') !== $postToken){
        return redirect()->action('RoomsController@show', $room->id);
      }

      $request->session()->forget('token');

      $chat=new Chat([
          'room_id' => $room->id,
          'comment' => $request->comment,
          'user_id' => Auth::user()->id]);
      $chat->save();

      return redirect()->action('RoomsController@show', $room);
  }

  //投稿削除
  public function destroy(chat $chat) {
      $chat->delete();
      if('1'==Auth::user()->admin_flag){
        return redirect()->action('AdminController@adminChats', $chat->id);
      }else{
        return redirect()->action('RoomsController@show', $chat->room_id);
      }
  }



}
