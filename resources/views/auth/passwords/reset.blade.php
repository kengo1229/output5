@extends('layouts.app')

@section('title', 'パスワード再設定')

@section('content')
<div id="app" class="u-display-flex-center">
    <div class="p-card p-card--margin-top60  u-bg-white u-border-default js-content-center-target">
        <div class="p-card__header">パスワード再設定</div>

        <div class="p-card__body">
            <form class="p-form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="p-form__group">
                    <label for="email">登録したメールアドレス<span class="c-badge">必須</span></label>

                    <input id="email" type="text" class="p-form__control @error('email') u-is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="password">新パスワード<br>(半角英数字6文字以上20文字以下)<span class="c-badge">必須</span></label>

                    <input id="password" type="password" class="p-form__control js-count1 @error('password') u-is-invalid @enderror" name="password" autocomplete="new-password">
                    <p class="u-float-right"><span class="js-show1">0</span>/20</p>

                    @error('password')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="password-confirm">新パスワード(確認用)<span class="c-badge">必須</span></label>

                    <input id="password-confirm" type="password" class="p-form__control" name="password_confirmation" autocomplete="new-password">
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn  u-float-right">
                        再設定
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
