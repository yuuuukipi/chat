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
    @foreach($room->users as $data)
      <a href="{{ action('UsersController@show', $data->id)}}" class="icon-rounded">{{$data->name}}</a>
      <br>
    @endforeach
  </div>

@endsection
