<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show(User $user){
      return view('users.show')->with('user', $user);
    }

    public function myshow(User $user){
      return view('users.mypage')->with('user', $user);
    }

    public function edit(User $user){
      return view('users.edit')->with('user', $user);
    }

    public function update(request $request, User $user){
      // dd(Auth::user()->name);
      Auth::user()->name=$request->name;
      Auth::user()->email=$request->email;
      Auth::user()->save();
      return redirect(url('mypage'));
    }

}
