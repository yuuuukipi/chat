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

  <div class="comment" style="margin-bottom:100px">

    @foreach($room->chats as $chat)

      @if((strcmp($chat->user_id,Auth::user()->id))==0)
        <div class="card col-md-8 offset-sm-4" style="background-color: gainsboro;">
          <p>{!! nl2br(e($chat->comment)) !!}</p>
          <div class="text-right post-date">{{ $chat->created_at }}　

            {{--記事の削除--}}
            <a href="#" class="del" data-id="{{ $chat->id }}">[削除]</a>
            <form method="post" action="{{ action('ChatsController@destroy', $chat) }}" id="form_{{ $chat->id }}">
              {{ csrf_field() }}
              {{ method_field('delete') }}
            </form>

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
            <p>{!! nl2br(e($chat->comment)) !!}</p>
            <div class="text-right post-date">{{ $chat->created_at }}</div>
          </div>
        </div>
      </div>
      <br>
      @endif
    @endforeach
    <script src="/js/main.js"></script>

  </div>

  <footer class="fixed-bottom mb-5">
    <div class='container'>

      <form method="post" action="{{ action('ChatsController@store', $room) }}">
        {{ csrf_field() }}
        <div class="input-group">
          <textarea name="comment" placeholder="コメント" class="form-control" rows="1">{{ old('comment') }}</textarea>
            <input type="hidden" name="token" value="{{$token}}">
            <input type="submit" value="送信">
        </div>
      </form>

      @if ($errors->has('comment'))
        <span class="error" style="color:tomato;">{{ $errors->first('comment')}}</span>
      @endif


    </div>

  </footer>

    <input type="hidden" id="id" name="id" value="{{$room->id}}">

  <script src="/js/scroll.js"></script>
  <script src="/js/update.js"></script>

@endsection
