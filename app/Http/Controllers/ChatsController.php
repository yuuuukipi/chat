<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\Auth;


class ChatsController extends Controller
{
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


}
