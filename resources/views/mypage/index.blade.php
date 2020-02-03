@extends('layouts.app')

@section('content')
  <h1>マイページ</h1>
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

      <h2>チャレンジ中のSTEP一覧</h2>
      <div class="row">
        <!-- 渡された$my_challenge_stepsが空の時は何も表示しない -->
        @if(isset($my_challenge_steps[0]))
        @foreach ($my_challenge_steps as $my_challenge_step)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              @if(($my_challenge_step->parentStep['pic']) != null)
                <div>
                  <img src="/{{ str_replace('public', 'storage', $my_challenge_step->parentStep['pic']) }}" alt="ステップ画像" width="200" height="130">
                </div>
              @else
                <div>
                  <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                </div>
              @endif
              <a href="">
                <h3 class="card-title">タイトル：{{ $my_challenge_step->parentStep['title']}}</h3>
              </a>
                <h3 class="card-title">カテゴリー：{{ $my_challenge_step->parentStep->category['category_name'] }}</h3>
                <h3 class="card-title">達成目安時間：{{ $my_challenge_step->parentStep['goal_time'] }}時間</h3>
                <h3 class="card-title">かかった時間：{{ $my_challenge_step['total_time'] }}時間</h3>
                <h3 class="card-title">進捗状況：<br>全5ステップ中{{$my_challenge_step['num_clear_child_step']}}ステップクリア！</h3>
            </div>
          </div>
        </div>

        @endforeach
        @endif
      </div>

      <h2>クリアしたSTEP一覧</h2>
      <div class="row">
        <!-- 渡された$my_finish_stepsが空の時は何も表示しない -->
        @if(isset($my_finish_steps[0]))
        @foreach ($my_finish_steps as $my_finish_step)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              @if(($my_finish_step->parentStep['pic']) != null)
                <div>
                  <img src="/{{ str_replace('public', 'storage', $my_finish_step->parentStep['pic']) }}" alt="ステップ画像" width="200" height="130">
                </div>
              @else
                <div>
                  <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                </div>
              @endif
              <a href="">
                <h3 class="card-title">タイトル：{{ $my_finish_step->parentStep['title']}}</h3>
              </a>
                <h3 class="card-title">カテゴリー：{{ $my_finish_step->parentStep->category['category_name'] }}</h3>
                <h3 class="card-title">達成目安時間：{{ $my_finish_step->parentStep['goal_time'] }}時間</h3>
                <h3 class="card-title">かかった時間：{{ $my_finish_step['total_time'] }}時間</h3>
            </div>
          </div>
        </div>

        @endforeach
        @endif
      </div>

    </div>

@endsection
