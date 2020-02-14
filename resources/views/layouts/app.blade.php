<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar u-bg-white u-shadow-sm  js-float-menu js-height-target">
      <div class="container">

          <div class="navbar-left">

            <img class="navbar-left-img"  src="{{ asset('/img/navbar_image.jpg') }}" alt="アイコン画像">
              <a class="navbar-brand" href="{{ url('/top') }}">
                  {{ config('app.name') }}
              </a>

          </div>

                @guest
                <ul class="navbar-nav  js-toggle-sp-menu-target">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                        </li>
                    @endif
                </ul>
                @else

                  <div class="menu-trigger js-toggle-sp-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>

                <ul class="navbar-nav nav-menu js-toggle-sp-menu-target">

                  <div class="menu">
                      <li class="menu-item">
                          <a class="nav-link" href="/top">TOP</a>
                      </li>
                      <li class="menu-item">
                          <a class="nav-link" href="/steps/new">STEP登録</a>
                      </li>
                      <li class="menu-item">
                          <a class="nav-link" href="/steps">STEP一覧</a>
                      </li>
                      <li class="menu-item">
                          <a class="nav-link" href="/profile/{{ Auth::id()}}/new">プロフィール登録(編集)</a>
                      </li>
                      <li class="menu-item">
                          <a class="nav-link" href="/mypage/{{ Auth::id()}}">マイページ</a>
                      </li>
                      <li class="menu-item">
                          <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              ログアウト
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </li>
                    </div>
                  </ul>
                @endguest
        </div>
    </nav>

    @if (session('flash_message'))
      <div class="alert alert-primary u-text-center" role="alert">
        {{ session('flash_message') }}
      </div>
    @endif

    @yield('top')

    <main class="l-main">
        @yield('content')
    </main>

<!-- footer -->
    <footer class="l-footer">
      <div class="container">
        <span class="u-text-muted">Copyright 2020 STEP. All Rights Reserved.</span>
      </div>
    </footer>
    <script src="{{ asset('js/app.js') }}" defer></script>
  </body>
</html>
