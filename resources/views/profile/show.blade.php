@extends('layouts.app')

@section('title', 'プロフィール')

@section('content')
<div class="p-user  js-height-hold">


      @if(($user->pic) != null)
          <img class="p-user__img u-margin-bottom-space_l" src="/{{ str_replace('public/', 'storage/', $user->pic) }}" alt="アイコン画像">
      @else
          <img class="p-user__img u-margin-bottom-space_l" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
      @endif

</div>

<div id="app" class="c-container">
    <div   class="c-row">

      <h2 class="u-secondary-title u-margin-bottom-space_l">

        @if(($user->username)  != null)
            {{$user->username}}さんのプロフィール
        @else
            [ユーザー名未設定]さんのプロフィール
        @endif

      </h2>

      <h2 class="u-secondary-title u-margin-bottom-space_l">自己紹介</h2>
      <p class="p-user__introduction u-bg-white">{{$user->introduction}}</p>


      <h2 class="u-secondary-title u-margin-bottom-space_l">登録したSTEP一覧</h2>
        <div class="p-individual-step-group">

            @foreach ($my_create_steps as $my_create_step)

                  <div class="p-individual-step u-margin-bottom-space_l  u-bg-white u-border-default">
                      <a class="p-step__link" href="{{ action('StepsController@show', $my_create_step->id) }}">
                        @if(($my_create_step->pic) != null)
                          <div>
                            <img class="p-step__img" src="/{{ str_replace('public', 'storage', $my_create_step->pic) }}" alt="ステップ画像">
                          </div>
                        @else
                          <div>
                            <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                          </div>
                        @endif
                        <div class="p-step__body">
                            <span class="u-underlineline-thin">タイトル</span>
                            <p>{{ $my_create_step->title }}</p>
                            <span class="u-underlineline-thin">カテゴリー</span>
                            <p>{{ $my_create_step->category->category_name }}</p>
                            <span class="u-underlineline-thin">達成目安時間</span>
                            <p>{{ $my_create_step->goal_time }}時間</p>
                        </div>
                      </a>
                  </div>


              @endforeach
        </div>


        </div>

      </div>

@endsection
