<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{
  public function index(){
    $rooms = Room::latest()->get();
    // dd($room->all());
    return view('rooms.index')->with('rooms', $rooms);
  }

}
