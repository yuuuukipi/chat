@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <div class='container'>
    <br><p class="text-muted">ユーザー一覧</p>
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
      <th>ユーザー名</th>
      <th>email</th>
      <th>パスワード</th>
      <th>登録日時</th>
      <th>管理者(1:管理者)</th>
      <th></th>
    </tr>

    @foreach($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td><a href="{{action('AdminController@admin_users_edit',$user)}}">編集</a></td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>******</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->admin_flag}}</td>
        <td><a href="#" class="del" data-id="{{ $user->id }}">削除</a>
          <form method="post" action="{{ action('AdminController@admin_users_destroy', $user) }}" id="form_{{ $user->id }}">
            {{ csrf_field() }}
            {{ method_field('delete') }}
          </form>
        </td>
      </tr>
    @endforeach

  </table>
  {{$users->links()}}
<script src="/js/main.js"></script>

@endsection
