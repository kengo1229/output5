@extends('layouts.app')

@section('content')
<div id="app" class="container">
  <div class="card bg-white border-default">
      <div class="card-header">新規登録</div>

      <div class="card-body">
          <form class="form" method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group row">
                  <label for="email" class="col-md-4"><p>メールアドレス</p></label>

                  <div class="col-md-6">
                      <input id="email" type="text" class="form-control border-default @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   autocomplete="email">

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group  row">
                  <label for="password" class="col-md-4">パスワード(半角英数字6文字以上20文字以下)</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label for="password-confirm" class="col-md-4">パスワード（確認用）</label>

                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                  </div>
              </div>

              <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary float-right">
                          登録
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
