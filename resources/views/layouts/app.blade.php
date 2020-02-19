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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="js-page-top">
  <nav class="p-navbar u-bg-white u-shadow-sm  js-float-menu">
    <div class="p-navbar__section">

          <div class="p-navbar-left">

            <img class="p-navbar-left__img"  src="{{ asset('/img/navbar_image.jpg') }}" alt="アイコン画像">
              <a class="p-navbar-left__title" href="{{ url('/') }}">
                  {{ config('app.name') }}
              </a>

          </div>

                @guest
                <ul class="p-nav  js-toggle-sp-menu-target">
                  @if (Route::has('register'))
                    <li class="p-nav__item">
                        <a class="p-nav__link" href="{{ route('register') }}">新規登録</a>
                    </li>
                  @endif

                    <li class="p-nav__item">
                        <a class="p-nav__link" href="{{ route('login') }}">ログイン</a>
                    </li>

                    <li class="p-nav__item">
                      <a class="p-hamburger-menu__link" href="/steps">STEP一覧</a>
                    </li>

                </ul>
                @else

                  <div class="c-menu-trigger js-toggle-sp-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>

                <ul class="p-nav c-menu-winow js-toggle-sp-menu-target">

                  <div class="p-hamburger-menu">
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="/">TOP</a>
                      </li>
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="/steps/new">STEP登録</a>
                      </li>
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="/steps">STEP一覧</a>
                      </li>
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="/profile/{{ Auth::id()}}/new">プロフィール登録(編集)</a>
                      </li>
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="/mypage/{{ Auth::id()}}">マイページ</a>
                      </li>
                      <li class="p-hamburger-menu__item">
                          <a class="p-hamburger-menu__link" href="{{ route('logout') }}"
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
      <div class="c-alert  u-text-center" role="alert">
        {{ session('flash_message') }}
      </div>
    @endif

    @yield('top')

    <main class="l-main">
        @yield('content')
    </main>

<!-- footer -->
    <footer class="l-footer">
      <div class="c-container">
        <span class="u-text-muted">Copyright 2020 STEP. All Rights Reserved.</span>
      </div>
    </footer>
    <script src="{{ asset('js/app.js') }}" defer></script>
  </body>
</html>
