<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>chat | @yield('title', 'Home')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>

  <body style="background-color: #f1a1a147; font-family:sans-serif;" class="text-muted";>
    @section('sidebar')
      <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #DDDDDD; position:fixed; width: 100%; z-index: 200;">
        <a href="{{ url('/') }}" >チャット</a>｜
        @guest
          <a href="{{ route('register') }}">会員登録</a>｜
          <a href="{{ route('login') }}">ログイン</a>｜
        @else
          <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                   ログアウト</a>
                   　　　　
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 {{ csrf_field() }}
             </form>
             <a href="#">{{(Auth::user()->name)}}</a>
        @endguest
      <br></nav>
      <br><br>
    @show
      <div class='container'>
        @yield('content')

      </div>

    @yield('footer')

      <script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>
