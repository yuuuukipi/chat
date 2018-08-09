@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">ユーザー登録入力確認画面</p>

@endsection

@section('content')
  <form method="POST" action="{{ route('register.complete.self') }}">
    {{ csrf_field() }}
      <div class="col-md-4 col-form-label">名前：
        <span>{{$user->name}}</span>
        <input type="hidden" name="name" value="{{$user->name}}">
      </div>

      <div class="col-md-4 col-form-label">メールアドレス：
        <span>{{$user->email}}</span>
        <input type="hidden" name="email" value="{{$user->email}}">
      </div>

      <div class="col-md-4 col-form-label">パスワード：
        <span>******</span>
        <input type="hidden" name="password" value="{{$user->password}}">
      </div>

      <div class="col-md-4 col-form-label">{{$user->admin}}</div>
      <input type="hidden" name="admin_flag" value="{{$user->admin_flag}}">
      <br><br>

      <button type="submit" class="btn btn-light text-muted">
        登録
      </button>
    <input type="hidden" name="token" value="{{$token}}">
  </form>
  <script src="{{ asset('js/app.js') }}"></script>

@endsection
