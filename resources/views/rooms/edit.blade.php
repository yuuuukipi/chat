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
    @foreach($del_users as $del_user)
      {{$del_user->name}}
      <a href="#" class="del" data-id="{{ $del_user->id }}">×</a>
      <form method="post" action="{{ action('RoomsController@destroyUser', ['room' => $room->id, 'user' => $del_user->id]) }}" id="form_{{ $del_user->id }}">
        <input type="hidden" name="user" value="{{$del_user->id}}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
      </form>
    @endforeach
    <br>

    <form method="post" action="{{action('RoomsController@add_user',$room)}}">
      {{ csrf_field() }}
      <p>＜ユーザー追加＞</p>
        @foreach($add_users as $add_user)
          @if((strcmp('0',$add_user->admin_flag))===0)
            <input type="checkbox" name="member[]" value="{{$add_user->id}}">
              {{$add_user->name}}
            <br>
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
