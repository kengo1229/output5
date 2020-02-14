@extends('layouts.app')

@section('title', 'パスワード再設定メール送信')

@section('content')
<div id="app" class="main-container">
    <div class="p-card  u-bg-white u-border-default js-content-center-target">
        <div class="p-card__header">パスワード再設定メール送信</div>

        <div class="p-card__body">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="p-form__group">
                    <label for="email" class="col-md-4">登録したメールアドレス<span class="c-badge ">必須</span></label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="p-form__control @error('email') u-is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                        @error('email')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="p-form__group">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="c-btn c-btn--primary u-float-right">
                            送信
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
