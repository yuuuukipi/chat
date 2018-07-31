<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $fillable = [
      'name', 'create_user',
  ];

  public function chats() {
    return $this->hasMany('App\Chat');
  }

  public function room_users(){
    return $this -> hasMany('App\Room_user');
  }

}
