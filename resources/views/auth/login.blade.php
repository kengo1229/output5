@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div id="app" class="main-container">
  <div class="c-card  u-bg-white u-border-default  js-content-center-target">
      <div class="c-card-header">ログイン</div>

      <div class="c-card-body">
          <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group">
                  <label for="email" class="col-md-4">メールアドレス</label>

                  <div class="col-md-6">
                      <input id="email" type="text" class="form-control @error('email') u-is-invalid @enderror" name="email" value="{{ old('email') }}"  autofocus>

                      @error('email')
                          <span class="u-invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group">
                  <label for="password" class="col-md-4">パスワード<br>(半角英数字6文字以上20文字以下)</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') u-is-invalid @enderror" name="password">

                      @error('password')
                          <span class="u-invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 offset-md-4">
                    @if (Route::has('password.request'))
                        <a class=" btn__link" href="{{ route('password.request') }}">
                            パスワードをお忘れの方はこちら
                        </a>
                    @endif


                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember">
                              ログイン状態を保持する
                          </label>
                      </div>
                  </div>


              </div>

              <div class="form-group">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="c-btn c-btn--primary u-float-right">
                          ログイン
                      </button>

                  </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
