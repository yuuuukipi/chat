@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">ユーザー編集</p>
    <div class="text-right">
      <a href="{{ url('rooms/admin/users') }}" class="header-menu">戻る</a>
    </div>
  </div>

@endsection
@section('content')

  <form method="post" action="{{ action('AdminController@update_user',$user) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>ユーザー名：
      <input type="text" name="name" value="{{old('name', $user->name) }}"></p>
    <p>email：
      <input type="text" name="email" value="{{old('email', $user->email) }}"></p>
      <br>
      <input type="submit" value="更新">
  </form><br>

@endsection
