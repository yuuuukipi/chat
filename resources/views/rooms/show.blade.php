@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}}</p>
    <li><a href="{{ action('RoomsController@member', $room)}}">メンバー 一覧</a></li>
    <li><a href="{{ action('RoomsController@edit', $room)}}">ルーム編集</a></li>
    <br><br>
  </div>


@endsection

@section('content')

  <div style="margin-bottom:100px">
    @foreach($room->chats as $chat)
      @if((strcmp($chat->user_id,Auth::user()->id))==0)
        <div class="card col-md-8 offset-sm-4" style="background-color: gainsboro;">
          <p id="a{{$chat->id}}">{!! nl2br(e($chat->comment)) !!}</p>
          <div class="text-right">{{ $chat->created_at->format('Y/m/d H:i') }}　
          </div>
        </div>
        <br>
      @else
      <div class="media">
        <div class="media-left">
          <a href="{{ action('UsersController@show', $chat->user)}}" class="icon-rounded">{{ $chat->user->name }}</a>
        </div>

        <div class="media-body">
          <div class="card col-md-8" style="background-color: aliceblue;">
            <p id="a{{$chat->id}}">{!! nl2br(e($chat->comment)) !!}</p>
            <div class="text-right">{{ $chat->created_at->format('Y/m/d H:i') }}　
            </div>
          </div>
        </div>
      </div>
      <br>
      @endif
    @endforeach
  </div>

  <footer class="fixed-bottom mb-5">
    <div class='container'>

      {{--<form method="post" action="{{ action('RoomsController@store', $room) }}">--}}
        <form method="post" action="{{ action('RoomsController@store', [$room, '#a'.$room->latest_id]) }}">
        {{ csrf_field() }}
        <div class="input-group">
          <textarea name="comment" placeholder="コメント" class="form-control" rows="1">{{ old('comment') }}</textarea>
            @if ($errors->has('comment'))
              <span class="error">{{ $errors->first('comment')}}</span>
            @endif

          <input type="submit" value="送信">
        </div>

      </form>


    </div>
  </footer>
@endsection
