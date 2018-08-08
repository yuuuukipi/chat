@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">投稿編集</p>
    <div class="text-right">
      <a href="{{ url('rooms/admin/chats') }}" class="header-menu">戻る</a>
    </div>
  </div>

@endsection
@section('content')
  <form method="post" action="{{ action('AdminController@update_chat',$chat) }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>投稿者：
      {{$chat->user->name}}
    </p>内容：
      <input type="text" name="comment" value="{{old('chat', $chat->comment) }}">
      <br><br>
      <input type="submit" value="更新">
  </form><br>


    <script src="/js/main.js"></script>
@endsection
