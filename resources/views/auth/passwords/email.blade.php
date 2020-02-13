@extends('layouts.app')

@section('title', 'パスワード再設定メール送信')

@section('content')
<div id="app" class="container">
    <div class="card  bg-white border-default js-content-center-target">
        <div class="card-header">パスワード再設定メール送信</div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="col-md-4">登録したメールアドレス<span class="badge badge-secondary">必須</span></label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary float-right">
                            送信
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
