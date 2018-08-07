@extends('layouts.default')
@section('title','TOP')
@section('sidebar')
  @parent
    <div class='container'>
      <br><p class="text-muted">トーク作成</p>
      <div class="text-right">
        <a href="{{ route('index') }}" class="header-menu">戻る</a>
      </div>

    </div>
@endsection

@section('content')

  チャットルームのメンバーを選択してください。<br><br>

  <form class="" method="POST" action="{{route('created_talk')}}">
    {{ csrf_field() }}
    @foreach($users as $user)
      @if ((strcmp($user->id,Auth::user()->id))!==0)
        <input type="checkbox" name="member[]" value="{{$user->id}}">
          {{$user->name}}
        <br>
      @endif
    @endforeach
    <br>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">トーク名</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>

      <div class='container'>
          <button type="submit" class="btn btn-light">
              作成
          </button>
      </div>
  </form>
@endsection
