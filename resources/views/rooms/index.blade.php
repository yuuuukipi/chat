@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br>
    <a href="{{ route('create_talk') }}">
      <button type="submit" class="btn btn-light">
          トーク作成
      </button>
    </a>
  </div>
  <div class='container'>
    <br><p class="text-muted">チャットルーム一覧</p>
  </div>
@endsection

@section('content')
  @foreach($rooms as $room)
    <li><a href="{{ action('RoomsController@show', $room)}}">{{$room->name}}</a></li>
  @endforeach

@endsection
