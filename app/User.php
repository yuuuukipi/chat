<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chats() {
        return $this->hasMany('App\Chat');
    }

    public function rooms() {
        return $this->belongsToMany('App\Room');
    }

    // public function room_users() {
    //     return $this->belongsToMany('App\Room_user');
    // }


}
