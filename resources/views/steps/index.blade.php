@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>STEP一覧</h2>
      <div class="row">

        @foreach ($index_steps as $one_step)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              @if(($one_step->pic) != null)
                <div>
                  <img src="{{ str_replace('public/', 'storage/', $one_step->pic) }}" alt="ステップ画像" width="200" height="130">
                </div>
              @else
                <div>
                  <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                </div>
              @endif
              <a href="{{ action('StepsController@show', $one_step->id) }}">
                <h3 class="card-title">タイトル：{{ $one_step->title }}</h3>
              </a>
                <h3 class="card-title">カテゴリー：{{ $one_step->category->category_name }}</h3>
                <h3 class="card-title">達成目安時間：{{ $one_step->goal_time }}時間</h3>
            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>

    {{ $index_steps->links() }}
@endsection
