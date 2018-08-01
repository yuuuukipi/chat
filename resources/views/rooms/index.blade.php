@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  @if (Auth::check())
      <div class='container'>
        <a href="{{ route('create_talk') }}">
          <button type="submit" class="btn btn-light">
              トーク作成
          </button>
        </a>
      </div>
      <div class='container'>
        <br><p class="text-muted">チャットルーム一覧</p>
      </div>
  @endif
@endsection

@section('content')
  @if (Auth::check())

      @foreach($rooms as $room)
        @foreach($room->room_users as $room->room_user)
            @if((strcmp($room->room_user->user_id,Auth::user()->id))==0)
              <li><a href="{{ action('RoomsController@show', ($room->max_id) ? [$room, '#a'.$room->max_id] :$room)}}">{{$room->name}}</a></li>
              {{--<li><a href="{{ action('RoomsController@show', $room)}}">{{$room->name}}</a></li>--}}
            @endif
        @endforeach
      @endforeach
  @else
    会員登録またはログインをしてください
  @endif

@endsection
