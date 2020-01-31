@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">プロフィール編集</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">ユーザー名(20文字以内)</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

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
                                <label for="introduction" class="col-md-4 col-form-label text-md-right">自己紹介</label>

                                <div class="col-md-6">
                                    <input id="introduction" type="textarea" class="form-control @error('introduction') is-invalid @enderror" name="introduction" value="{{ old('introduction', $user->introduction) }}" autocomplete="introduction" autofocus>

                                    @error('introduction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <p  class="col-md-4 col-form-label text-md-right">登録したアイコン画像</p>

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
                                <label for="pic" class="col-md-4 col-form-label text-md-right">新しい画像</label>

                                <div class="col-md-6">

                                    <input id="pic" type="file" class="form-control @error('pic') is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                                    @error('pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        編集
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
