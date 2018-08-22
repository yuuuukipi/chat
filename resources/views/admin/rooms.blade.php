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

  <table border="1" width="100%">
    <tr>
      <th>ID</th>
      <th></th>
      <th>ルーム名</th>
      <th>作成者</th>
      <th>作成日時</th>
      <th>最終更新日時</th>
      {{--<th>最終投稿日時</th>--}}
      {{--<th>メンバー</th>--}}
      <th></th>
    </tr>

    @foreach($rooms as $room)
      <tr>
        <td>{{$room->id}}</td>
        <td><a href="{{action('AdminController@adminRoomsEdit',$room)}}">編集</a></td>
        <td>{{$room->name}}</td>
        <td>{{$room->create_user}}</td>
        <td>{{$room->created_at}}</td>
        <td>{{$room->updated_at}}</td>
        {{--<td>2018-XX-XX</td>--}}
        {{--<td><a href="post_edit.php?mode=change">詳細</td>--}}
        <td><a href="#" class="del" data-id="{{ $room->id }}">削除</a>
          <form method="post" action="{{ action('RoomsController@destroyRoom', $room) }}" id="form_{{ $room->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
          </form>
        </td>
      </tr>
    @endforeach

  </table>
  {{$rooms->links()}}
  <script src="/js/main.js"></script>

@endsection
