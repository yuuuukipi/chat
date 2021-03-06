<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $fillable = [
      'room_id', 'comment', 'user_id'
  ];

  public function room(){
    return $this -> belongsTo('App\Room');
  }

  public function user(){
    return $this -> belongsTo('App\User');
  }


}
