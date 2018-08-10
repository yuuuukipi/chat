@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}}</p>
    メンバー一覧<br>
    <div class="text-right">
        <a href="{{ action('RoomsController@show', $room) }}" class="header-menu">戻る</a>
    </div>

  </div>


@endsection

@section('content')

  <div>
    @foreach($room->room_users as $data)
      <a href="{{ action('UsersController@show', $data->user)}}" class="icon-rounded">{{$data->user->name}}</a>
      <br>
    @endforeach
  </div>

@endsection
