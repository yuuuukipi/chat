@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">ルーム編集</p>
    <div class="text-right">
      <a href="{{ url('rooms/admin/rooms') }}" class="header-menu">戻る</a>
    </div>
  </div>

@endsection
@section('content')

  <form method="post" action="{{ action('AdminController@updateRoom',$room) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>ルーム名：
      <input type="text" name="name" value="{{old('name', $room->name) }}">
    </p>作成者：
      <input type="text" name="create_user" value="{{old('create_user', $room->create_user) }}">
      <br><br>
      <input type="submit" value="更新">
  </form><br>

  <p>メンバー：</p>
  @foreach($delUsers as $del_user)
    {{$del_user->name}}
    <a href="#" class="del" data-id="{{ $del_user->id }}">×</a>
    <form method="post" action="{{ action('RoomsController@destroyUser', ['room' => $room->id, 'user' => $del_user->id]) }}" id="form_{{ $del_user->id }}">
      <input type="hidden" name="user" value="{{$del_user->id}}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
  @endforeach
  <br>

  <form method="post" action="{{action('RoomsController@addUser',$room)}}">
    {{ csrf_field() }}
    <p>＜ユーザー追加＞</p>
    @foreach($addUsers as $add_user)
      @if((strcmp('0',$add_user->admin_flag))===0)
        <input type="checkbox" name="member[]" value="{{$add_user->id}}">
          {{$add_user->name}}
        <br>
      @endif
    @endforeach
    <br>
    <button type="submit" class="btn btn-light">
        追加
    </button>
  </form><br>

    <a href="#" class="del" data-id="{{ $room->id }}">★ルーム削除</a>
    <form method="post" action="{{ action('RoomsController@destroyRoom', $room) }}" id="form_{{ $room->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
    <br>

    <script src="/js/main.js"></script>
@endsection
