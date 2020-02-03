@extends('layouts.app')

@section('content')
  <p>
    @if(($user->pic) != null)
      <div>
        <img src="/{{ str_replace('public/', 'storage/', $user->pic) }}" alt="アイコン画像" width="200" height="130">
      </div>
    @else
      <div>
        <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
      </div>
    @endif
  </p>
  <p>
    @if(($user->username)  != null)
        {{$user->username}}さんのプロフィール
    @else
        [ユーザー名未設定]さんのプロフィール
    @endif
  <p>
  自己紹介
  <p>{{$user->introduction}}</p>
    <div class="container">
      <h2>登録したSTEP一覧</h2>
      <div class="row">

        @foreach ($my_create_steps as $my_create_step)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              @if(($my_create_step->pic) != null)
                <div>
                  <img src="/{{ str_replace('public', 'storage', $my_create_step->pic) }}" alt="ステップ画像" width="200" height="130">
                </div>
              @else
                <div>
                  <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                </div>
              @endif
              <a href="{{ action('StepsController@show', $my_create_step->id) }}">
                <h3 class="card-title">タイトル：{{ $my_create_step->title }}</h3>
              </a>
                <h3 class="card-title">カテゴリー：{{ $my_create_step->category->category_name }}</h3>
                <h3 class="card-title">達成目安時間：{{ $my_create_step->goal_time }}</h3>
            </div>
          </div>
        </div>

        @endforeach
      </div>


@endsection
