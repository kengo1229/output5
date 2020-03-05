@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div id="app" class="u-display-flex-center">
    <div class="p-card p-card--margin-top60 u-bg-white u-border-default js-content-center-target">
        <div class="p-card__header">ログイン</div>

        <div class="p-card__body">
            <form  class="p-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="p-form__group">
                    <label for="email">メールアドレス</label>

                    <input id="email" type="text" class="p-form__control @error('email') u-is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                    @error('email')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="password">パスワード<br>(半角英数字6文字以上20文字以下)</label>

                    <input id="password" type="password" class="p-form__control @error('password') u-is-invalid @enderror" name="password">

                    @error('password')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    @if (Route::has('password.request'))
                    <a class="btn__link" href="{{ route('password.request') }}">
                        パスワードをお忘れの方はこちら
                    </a>
                    @endif

                    <div>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember">
                            ログイン状態を保持する
                        </label>
                    </div>
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn u-float-right">
                        ログイン
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
