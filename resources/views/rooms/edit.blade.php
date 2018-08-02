@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">{{$room->name}}</p>
    編集画面

    <br>
  </div>


@endsection

@section('content')

  <a href="#" class="del" data-id="{{ $room->id }}">ルーム削除</a>
  <form method="post" action="{{ action('RoomsController@destroy_room', $room) }}" id="form_{{ $room->id }}">
    {{ csrf_field() }}
    {{ method_field('delete') }}
  </form>

  <div><br>
    <p>＜ユーザー削除＞</p>
    @foreach($room->room_users as $data)
      <a href="#">×</a>
      {{$data->user->name}}
      <br>
    @endforeach
    <br>
    <p>＜ユーザー追加＞</p>

    @foreach($users as $user)
      @if (strcmp($user->id,Auth::user()->id)!==0)
          @foreach($room->room_users as $data)
            @if (strcmp($user->id,$data->user->id)===0)
                @break
                <input type="checkbox" name="member[]" value="{{$user->id}}">
                  {{$user->name}}
                <br>
            @endif
          @endforeach
      @endif
    @endforeach

  </div>
  <script src="/js/main.js"></script>
@endsection
