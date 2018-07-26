@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">- - - - - トーク一覧 - - - - -</p>

@endsection

@section('content')
  @foreach($rooms as $room)
    <li><a href="">{{$room->name}}</a></li>
  @endforeach
@endsection
