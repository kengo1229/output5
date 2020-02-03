@extends('layouts.app')

@section('content')
<p>トップ画像</p>

<h2>登録したSTEP一覧</h2>
<div class="row">

  @foreach ($latest_parent_steps as $latest_parent_step)

  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        @if(($latest_parent_step->pic) != null)
          <div>
            <img src="/{{ str_replace('public', 'storage', $latest_parent_step->pic) }}" alt="ステップ画像" width="200" height="130">
          </div>
        @else
          <div>
            <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
          </div>
        @endif
        <a href="{{ action('StepsController@show', $latest_parent_step->id) }}">
          <h3 class="card-title">タイトル：{{ $latest_parent_step->title }}</h3>
        </a>
          <h3 class="card-title">カテゴリー：{{ $latest_parent_step->category->category_name }}</h3>
          <h3 class="card-title">達成目安時間：{{ $latest_parent_step->goal_time }}</h3>
      </div>
    </div>
  </div>

  @endforeach

@endsection
