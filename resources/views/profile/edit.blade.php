@php
$title = 'プロフィール編集';
@endphp

@extends('layouts.app')

@section('content')
<div id="app" class="u-display-flex-center js-height-hold">
    <div class="p-card u-bg-white u-border-default">
        <div class="p-card__header">プロフィール編集</div>


        <div class="p-card__body">
            <form class="p-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="p-form__group">
                    <label for="username">ユーザー名(20文字以下)<span class="c-badge">必須</span></label>

                    <input id="username" type="text" class="p-form__control js-count1 @error('username') u-is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" autocomplete="username" autofocus>
                    <p class="u-float-right"><span class="js-show1">0</span>/20</p>

                    @error('username')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="email">メールアドレス<span class="c-badge">必須</span></label>

                    <input id="email" type="text" class="p-form__control @error('email') u-is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" autofocus>

                    @error('email')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <label for="introduction">自己紹介（200文字以下）<span class="c-badge">必須</span></label>

                    <textarea id="introduction" class="p-form__control p-form__textarea js-count2 @error('introduction') u-is-invalid @enderror" name="introduction" autocomplete="introduction" autofocus>{{ old('introduction', $user->introduction) }}</textarea>
                    <p class="u-float-right"><span class="js-show2">0</span>/200</p>

                    @error('introduction')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <p>登録したアイコン画像</p>

                    @if(($user->pic) != null )
                    <div>
                        <img src="{{ $user->pic }}" class="p-form__img" alt="アイコン画像">
                    </div>
                    @else
                    <div>
                        <img src="{{asset('/img/no_image.jpg')}}" class="p-form__img" alt="登録画像なし">
                    </div>
                    @endif
                </div>

                <div class="p-form__group">
                    <label for="pic">新しい画像（jpg/jpeg/png）<span class="c-badge">任意</span></label>

                    <input id="pic" type="file" class="p-form__control p-form__pic @error('pic') u-is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                    @error('pic')
                    <p class="u-invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>


                <div class="p-form__group">
                    <button type="submit" class="c-btn u-float-right">
                        編集
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
