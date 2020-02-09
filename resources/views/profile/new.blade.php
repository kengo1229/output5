@extends('layouts.app')

@section('content')
    <div id="app" class="container">
                <div class="card bg-white border-default">
                    <div class="card-header">プロフィール登録</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.create', $user->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4">ユーザー名(20文字以内)</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4">メールアドレス</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="title" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="introduction" class="col-md-4  ">自己紹介(200文字以内)</label>

                                <div class="col-md-6">
                                  <textarea id="introduction"  class="form-control form-control-textarea @error('introduction') is-invalid @enderror" name="introduction" value="" autocomplete="introduction" autofocus>{{ old('introduction') }}</textarea>
                                    @error('introduction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="pic" class="col-md-4  ">アイコン画像：任意</label>

                                <div class="col-md-6">

                                    <input id="pic" type="file" class="form-control form-control-pic @error('pic') is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                                    @error('pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
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
