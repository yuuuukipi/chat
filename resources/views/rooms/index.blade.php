@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
@endsection

@section('content')
  @if (Auth::check())
      @if('1'==Auth::user()->admin_flag)
        <br><p class="text-muted">管理者画面</p>
        <a href="{{ url('/rooms/admin/users') }}">▼ユーザー一覧</a><br><br><br>
        <a href="{{ url('/rooms/admin/rooms') }}">▼ルーム一覧</a><br><br>
        <a href="{{ url('/rooms/admin/chats') }}">▼投稿一覧</a><br><br>

      @else
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

      @foreach($rooms as $room)
        @foreach($room->room_users as $room->room_user)
            @if((strcmp($room->room_user->user_id,Auth::user()->id))==0)
              {{--<li><a href="{{ action('RoomsController@show', ($room->max_id) ? [$room, '#a'.$room->max_id] :$room)}}">{{$room->name}}</a></li>--}}
              <li><a href="{{ action('RoomsController@show', $room)}}">{{$room->name}}</a></li>
            @endif
        @endforeach
      @endforeach

    @endif
  @else
    会員登録またはログインをしてください
  @endif

@endsection
