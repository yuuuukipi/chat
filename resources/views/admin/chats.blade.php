@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">チャット一覧</p>
    <div class="text-right">
      <a href="{{ route('index') }}" class="header-menu">戻る</a>
    </div>

  </div>

@endsection
@section('content')
  @foreach($chats as $chat)

      <p>コメント：{{$chat->comment}}</p>
      <p>投稿者：{{$chat->user->name}}</p>
  @endforeach
  {{$chats->links()}}

@endsection
