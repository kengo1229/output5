@extends('layouts.app')

@section('title', 'パスワード再設定')

@section('content')
<div id="app" class="container">
        <div class="card  bg-white border-default js-content-center-target">
            <div class="card-header">パスワード再設定</div>

            <div class="card-body">
                <form class="form" method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="col-md-4">登録したメールアドレス<span class="badge badge-secondary">必須</span></label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}"  autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4  ">新パスワード<span class="badge badge-secondary">必須</span><br>(半角英数字6文字以上20文字以内)</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control js-count1 @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                            <p class="float-right"><span class="js-show1">0</span>/20</p>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4  ">新パスワード(確認用)<span class="badge badge-secondary">必須</span></label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary  float-right">
                                再登録
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
@endsection
