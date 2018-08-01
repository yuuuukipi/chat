@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}}</p>
    <li><a href="{{ action('RoomsController@show', $room)}}">メンバー一覧</a></li>

    <br><br>
  </div>


@endsection

@section('content')
      {{--
      <div class="card-body">
        <div class="media">
          <div class="media-left">
            <a href="#" class="icon-rounded">S</a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">Suzuki Taro Date:2016/09/01</h4>
            <div>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</div>
          </div>
        </div>
        <hr>
        <div class="media">
          <div class="media-body">
            <h4 class="media-heading">Tanaka Jiro Date:2016/09/01</h4>
            <div>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</div>
          </div>
          <div class="media-right">
            <a href="#" class="icon-rounded">T</a>
          </div>
        </div>
      </div>

  <div style="margin-bottom:100px">
    @foreach($room->chats as $chat)
      @if((strcmp($chat->user_id,Auth::user()->id))==0)
        1
        <div class="card">
          <p id="a{{$chat->id}}">{{ $chat->comment }}</p>
            <div class="text-right">{{ $chat->created_at->format('Y/m/d H:i') }}　
            <a href="#" data-id="{{ $comment->id }}" class="pull-right del">[削除]</a>
            <form method="post" action="{{ action('CommentsController@destroy', [$chat, $comment] )}}" id="form_{{ $comment->id }}">
              {{ csrf_field() }}
              {{ method_field('delete') }}
            </form>
          </div>
        </div>
      @else
      2
      @endif
    @endforeach
  </div>
  --}}


  <div style="margin-bottom:100px">
    @foreach($room->chats as $chat)
      @if((strcmp($chat->user_id,Auth::user()->id))==0)
        <div class="card col-md-8 offset-sm-4" style="background-color: gainsboro;">
          <p id="a{{$chat->id}}">{{ $chat->comment }}</p>
          <div class="text-right">{{ $chat->created_at->format('Y/m/d H:i') }}　
          </div>
        </div>
        <br>
      @else
      <div class="media">
        <div class="media-left">
          <a href="#" class="icon-rounded">{{ $chat->user->name }}</a>
        </div>

        <div class="media-body">
          <div class="card col-md-8" style="background-color: aliceblue;">
            <p id="a{{$chat->id}}">{{ $chat->comment }}</p>
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

      <form method="post" action="{{ action('ChatsController@store', $room) }}">
        {{ csrf_field() }}
        <div class="input-group">

          <input type="text" name="comment" class="form-control" value="{{old('comment') }}">
            @if ($errors->has('comment'))
              <span class="error">{{ $errors->first('comment')}}</span>
            @endif

          <input type="submit" value="送信">
        </div>

      </form>


    </div>
  </footer>
@endsection
