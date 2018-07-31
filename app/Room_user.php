<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_user extends Model
{
  protected $fillable = [
      'room_id', 'user_id',
  ];

  public $timestamps = false;


  public function room(){
    return $this -> belongsTo('App\Room');
  }

  public function user(){
    return $this -> belongsTo('App\User');
  }


}
