@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}}</p>
    編集画面
    <div class="text-right">
      <a href="{{ action('RoomsController@show', $room) }}" class="header-menu">戻る</a>
    </div>
  </div>


@endsection

@section('content')

  <a href="#" class="del" data-id="{{ $room->id }}">ルーム削除</a>
  <form method="post" action="{{ action('RoomsController@destroyRoom', $room) }}" id="form_{{ $room->id }}">
    {{ csrf_field() }}
    {{ method_field('delete') }}
  </form>

  <div><br>

  <p>＜ユーザー削除＞</p>
    @foreach($delUsers as $delUser)
      {{$delUser->name}}
      <a href="#" class="del" data-id="{{ $delUser->id }}">×</a>
      <form method="post" action="{{ action('RoomsController@destroyUser', ['room' => $room->id, 'user' => $delUser->id]) }}" id="form_{{ $delUser->id }}">
        <input type="hidden" name="user" value="{{$delUser->id}}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
      </form>
    @endforeach
    <br>

    <form method="post" action="{{action('RoomsController@addUser',$room)}}">
      {{ csrf_field() }}
      <p>＜ユーザー追加＞</p>
        @foreach($addUsers as $addUser)
          @if(!($delUsers->contains($addUser)))
            @if((strcmp('0',$addUser->admin_flag))===0)
              <input type="checkbox" name="member[]" value="{{$addUser->id}}">
                {{$addUser->name}}
              <br>
            @endif
          @endif
        @endforeach

      @if ($errors->has('member'))
        <br><span class="error" style="color:tomato;">{{ $errors->first('member')}}</span>
      @endif
      <br>

      <button type="submit" class="btn btn-light">
          追加
      </button>
    </form>
  </div><br>
  <script src="/js/main.js"></script>
@endsection
