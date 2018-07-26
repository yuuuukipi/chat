@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
  <br><p class="text-muted text-center">ユーザー登録入力確認画面</p>

@endsection

@section('content')
  <form class="form-horizontal" method="POST" action="{{ route('register.check') }}">
    {{ csrf_field() }}
    <p>名前</p>
    <input type="text" name="name" class="form-control" style="margin: 10px;" value="{{old('name') }}">

    <p>メールアドレス</p>
    <input type="text" name="name" class="form-control" style="margin: 10px;" value="{{old('name') }}">
  </form>
@endsection
