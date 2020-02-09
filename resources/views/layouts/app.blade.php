<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        <nav class="navbar   bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/top') }}">
                    {{ config('app.name') }}
                </a>


                    <ul class="navbar-nav">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                              <li class="nav-item">
                                  <a class="nav-link" href="/steps/new">STEP登録</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/steps">チャレンジ</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/profile/{{ Auth::id()}}/new">プロフィール登録(編集)</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="/mypage/{{ Auth::id()}}">マイページ</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                      ログアウト
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                                  </li>
                            </li>
                        @endguest
                    </ul>
            </div>
        </nav>

        @if (session('flash_message'))
          <div class="alert alert-primary text-center" role="alert">
            {{ session('flash_message') }}
          </div>
        @endif

        <main class="main">
            @yield('content')
        </main>

    <!-- footer -->
        <footer class="footer">
          <div class="container">
            <span class="text-muted">Copyright 2020 STEP. All Rights Reserved.</span>
          </div>
        </footer>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
