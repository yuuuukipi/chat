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

  // public function users(){
  //   return $this -> hasMany('App\User');
  // }

  // public function room_users(){
  //   return $this->hasMany('App\Room_user');
  // }
  // public function room_users(){
  //   return $this->belongsToMany('App\Room_user');
  // }
  //
  public function users(){
    return $this->belongsToMany('App\User');
  }

}
