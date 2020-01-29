@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>STEP一覧</h2>
      <div class="row">

        @foreach ($index_step_info as $one_step_info)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              @if(($one_step_info->pic) !== null)
                <div>
                  <img src="{{ str_replace('public/', 'storage/', $one_step_info->pic) }}" alt="ステップ画像" width="200" height="130">
                </div>
              @else
                <div>
                  <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                </div>
              @endif
              <a href="{{ action('StepsController@show', $one_step_info->id) }}">
                <h3 class="card-title">タイトル：{{ $one_step_info->title }}</h3>
              </a>
                <h3 class="card-title">カテゴリー：{{ $one_step_info->category->category_name }}</h3>
                <h3 class="card-title">目標時間：{{ $one_step_info->goal_time }}時間</h3>
            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>

    {{ $index_step_info->links() }}
@endsection
