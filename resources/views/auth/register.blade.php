@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">ユーザー登録</p>

@endsection

@section('content')
{{--dd(2)--}}
<div class="card-body">
  <form class="form-horizontal" method="POST" action="{{ route('register.check') }}">
    {{ csrf_field() }}

      <div class="col-md-6">
        名前
        <input type="text" name="name" class="form-control" value="{{old('name') }}">
      </div>

      <div class="col-md-6">
        メールアドレス
        <input type="text" name="email" class="form-control" value="{{old('email') }}">
      </div>

      <div class="form-group">
          <label for="password" class="col-md-4 control-label">パスワード</label>
          <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>
          </div>
      </div>


      <div class="form-group">
          <label for="password-confirm" class="col-md-4 control-label">パスワード確認</label>
          <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
      </div>

      <br>
      <button type="submit" class="btn btn-light text-muted">
        確認画面へ
      </button>


  </form>
</div>
@endsection
