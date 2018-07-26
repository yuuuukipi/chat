<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>chat | @yield('title', 'Home')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>

  <body style="background-color: #f1a1a147;" class="text-muted";>
    @section('sidebar')
      <nav class="navbar navbar-expand-md navbar-dark bg-light" style="background-color: #f1a1a147;">
        <a href="{{ url('/') }}">チャット</a>
        @guest
          <a href="{{ url('/register' )}}">会員登録</a>
          <a href="{{ url('/login' )}}">ログイン</a>
        @else
          <a href="{{ url('/logout' )}}">ログアウト</a>
        @endguest
      </nav>

    @show
      <div class='container'>
        @yield('content')
      </div>
  </body>
</html>
