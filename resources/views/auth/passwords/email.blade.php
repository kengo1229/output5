@php
$title = 'パスワード再設定メール送信';
@endphp

@extends('layouts.app')

@section('content')
<div id="app" class="u-display-flex-center">
    <div class="p-card p-card--margin-top120  u-bg-white u-border-default js-content-center-target">
        <div class="p-card__header">パスワード再設定メール送信</div>

        <div class="p-card__body">
            <form class="p-form" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="p-form__group">
                    <label for="email">登録したメールアドレス<span class="c-badge">必須</span></label>

                    <input id="email" type="text" class="p-form__control @error('email') u-is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn u-float-right">
                        送信
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
