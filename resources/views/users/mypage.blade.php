@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">マイページ</p>
    {{--<li><a href="{{ action('ChatsController@member', $room)}}">メンバー一覧</a></li>--}}

    <br>
  </div>

@endsection

@section('content')
<p>
名前：{{Auth::user()->name}}
</p><p>
メールアドレス：{{Auth::user()->email}}
</p>
<a href="{{ action('UsersController@edit') }}">
  <button type="submit" class="btn btn-light">
      プロフィール更新
  </button>
</a>

@endsection
