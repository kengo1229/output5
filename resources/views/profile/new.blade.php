@extends('layouts.app')

@section('title', 'プロフィール登録')

@section('content')
    <div id="app" class="u-display-flex-center  js-height-hold">
        <div class="p-card  u-bg-white u-border-default ">
            <div class="p-card__header">プロフィール登録</div>

            <div class="p-card__body">
                <form method="POST" action="{{ route('profile.create', $user->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="p-form__group">
                        <label for="username" class="col-md-4">ユーザー名(20文字以下)<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="p-form__control js-count1 @error('username') u-is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                            <p class="u-float-right"><span class="js-show1">0</span>/20</p>

                            @error('username')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-form__group">
                        <label for="email" class="col-md-4">メールアドレス<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="p-form__control  @error('email') u-is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="title" autofocus>

                            @error('email')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-form__group">
                        <label for="introduction" class="col-md-4">自己紹介(200文字以下)<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                          <textarea id="introduction"  class="p-form__control p-form__textarea js-count2 @error('introduction') u-is-invalid @enderror" name="introduction" value="" autocomplete="introduction" autofocus>{{ old('introduction') }}</textarea>
                          <p class="u-float-right"><span class="js-show2">0</span>/200</p>

                            @error('introduction')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="p-form__group">
                        <label for="pic" class="col-md-4  ">アイコン画像<span class="c-badge ">任意</span></label>

                        <div class="col-md-6">

                            <input id="pic" type="file" class="p-form__control p-form__pic @error('pic') u-is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                            @error('pic')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="p-form__group mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="c-btn c-btn--primary u-float-right">
                                登録
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
