@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent

  <div class='container'>
    <br><p class="text-muted">プロフィール編集</p>

    <div class="text-right">
      <a href="{{ url('/mypage') }}" class="header-menu">戻る</a>
    </div>
  </div>

@endsection

@section('content')

  <form method="post" action="{{ url('/mypage') }}">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <p>名前：
      <input type="text" name="name" value="{{old('name', Auth::user()->name) }}">
    </p>メールアドレス：
      <input type="text" name="email" value="{{old('email', Auth::user()->email) }}">
    <br><br>

    <input type="submit" value="更新">
  </form>

@endsection
