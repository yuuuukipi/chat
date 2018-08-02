@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}} 編集</p>
    <br>
  </div>


@endsection

@section('content')

  <div>
    @foreach($room->room_users as $data)
      {{$data->user->name}}
      <br>
    @endforeach
  </div>

@endsection
