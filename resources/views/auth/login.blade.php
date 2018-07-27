@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">ログイン</p>

@endsection

@section('content')

<form method="POST" action="{{route('signin')}}">
  {{ csrf_field() }}

    <div class="col-md-6">
      メールアドレス
      <input type="text" name="email" class="form-control" value="{{old('email') }}">
    </div><br>

    <div class="col-md-6">
        パスワード
      <input id="password" type="password" class="form-control" name="password" required>
    </div><br><br>

    <button type="submit" class="btn btn-light text-muted">
      送信
    </button>


</form>

@endsection
