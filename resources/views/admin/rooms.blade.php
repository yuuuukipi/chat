@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">ルーム一覧</p>
    <div class="text-right">
      <a href="{{ route('index') }}" class="header-menu">戻る</a>
    </div>

  </div>

@endsection
@section('content')
    @foreach($rooms as $room)
        <li>{{$room->name}}</li>
    @endforeach

@endsection
