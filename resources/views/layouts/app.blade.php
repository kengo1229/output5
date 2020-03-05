<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
      <meta charset="utf-8">

      <!-- ==============================================
    	  サイトタイトル
    	=============================================== -->
    	<title>@php echo $title  @endphp  | 共有型学習支援サービス「STEP」</title>

    	<!-- ==============================================
    		metaタグ
    	=============================================== -->
    	<meta name="author" content="STEP" />
      <meta name="description" content="学習や成長に必要な【これが良かった】という【順番】と【方法】を【STEP】で共有し、他の人はその【STEP】を元に学習を進めて成長していけるサービスです。" />
      <meta name="keywords" content="学習,方法,やり方,順番,共有" />
      <meta name="application-name" content="STEP - 最良の学びや成長の方法が共有できる学習支援サービス" />

      <!-- ==============================================
    		OGPタグ(本番環境で実行できなかったら無駄なコードなので消す)
    	=============================================== -->
      <meta property="og:title" content="共有型学習支援サービス" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://webukatustep.herokuapp.com/" />
      <meta property="og:image" content="https://webukatustep.herokuapp.com/img/navbar_image.jpg" />
      <meta property="og:site_name" content="共有型学習支援サービス「STEP」" />
      <meta property="og:description" content="学習や成長に必要な最良の【順番】と【方法】を【STEP】で共有し、その【STEP】を元に成長していける共有型学習支援サービス" />
      <meta name="twitter:card" content="summary_large_image" />

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>

  <body id="js-position-top">
      <nav class="p-navbar u-bg-white u-shadow-sm  js-float-menu">
          <div class="p-navbar__section">

              <div class="p-navbar-left">

                  <img class="p-navbar-left__img" src="{{ asset('/img/navbar_image.jpg') }}" alt="アイコン画像">
                  <a class="p-navbar-left__title" href="{{ url('/') }}">
                      {{ config('app.name') }}
                  </a>

              </div>

              @guest
              <ul class="p-nav js-toggle-sp-menu-target">
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
              @endguest

              @auth
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
                          <a class="p-hamburger-menu__link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                              ログアウト
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </li>
                  </div>
              </ul>
              @endauth
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
              <p class="u-text-muted">Copyright 2020 STEP. All Rights Reserved.</p>
          </div>
      </footer>
      <script src="{{ asset('js/app.js') }}" defer></script>
  </body>

</html>
