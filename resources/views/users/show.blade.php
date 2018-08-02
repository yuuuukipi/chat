@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$user->name}}</p>
    {{--<li><a href="{{ action('ChatsController@member', $room)}}">メンバー一覧</a></li>--}}

    <br><br>
  </div>


@endsection

@section('content')

@endsection
