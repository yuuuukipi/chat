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

{{$chats->links()}}

    <table border="1" width="100%">
      <tr>
        <th>ID</th>
        <th></th>
        <th>ルーム名</th>
        <th>投稿者</th>
        <th>内容</th>
        <th>投稿日時</th>
        <th>更新日時</th>
        <th>メンバー</th>
      </tr>

      @foreach($chats as $chat)
        <tr>
          <td>{{$chat->id}}</td>
          <td><a href="{{action('AdminController@admin_chats_edit',$chat)}}">編集</a></td>
          <td>{{$chat->room->name}}</td>
          <td>{{$chat->user->name}}</td>
          <td>{{$chat->comment}}</td>
          <td>{{$chat->created_at}}</td>
          <td>{{$chat->updated_at}}</td>
          <td><a href="#" class="del" data-id="{{ $chat->id }}">削除</a>
            <form method="post" action="{{ action('RoomsController@destroy', $chat) }}" id="form_{{ $chat->id }}">
              {{ csrf_field() }}
              {{ method_field('delete') }}
            </form>
          </td>
        </tr>
      @endforeach

    </table>
    {{$chats->links()}}
    <script src="/js/main.js"></script>


@endsection
