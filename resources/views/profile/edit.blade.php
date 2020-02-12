@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <div id="app" class="container js-height-hold">
        <div class="card bg-white border-default">
            <div class="card-header">プロフィール編集</div>


            <div class="card-body">
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="username" class="col-md-4">ユーザー名(20文字以内)<span class="badge badge-secondary">必須</span></label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control js-count1 @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" autocomplete="username" autofocus>
                            <p class="float-right"><span class="js-show1">0</span>/20</p>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4  ">メールアドレス<span class="badge badge-secondary">必須</span></label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="introduction" class="col-md-4  ">自己紹介<span class="badge badge-secondary">必須</span></label>

                        <div class="col-md-6">
                            <textarea id="introduction"  class="form-control form-control-textarea js-count2  @error('introduction') is-invalid @enderror" name="introduction"  autocomplete="introduction" autofocus>{{ old('introduction', $user->introduction) }}</textarea>
                            <p class="float-right"><span class="js-show2">0</span>/200</p>

                            @error('introduction')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <p  class="col-md-4  ">登録したアイコン画像</p>

                        <div class="col-md-6">

                          @if(($user->pic) != null )
                            <div>
                              <img src="/{{ $user->pic }}" alt="アイコン画像" width="200" height="130">
                            </div>
                          @else
                            <div>
                              <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                            </div>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pic" class="col-md-4  ">新しい画像<span class="badge badge-secondary">任意</span></label>

                        <div class="col-md-6">

                            <input id="pic" type="file" class="form-control form-control-pic @error('pic') is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                            @error('pic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary float-right">
                                編集
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
