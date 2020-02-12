@extends('layouts.app')

@section('title', 'マイページ')

@section('content')


<div class="user margin-bottom-space_l js-height-hold">

      @if(($user->pic) != null)
          <img class="user-img" src="/{{ str_replace('public/', 'storage/', $user->pic) }}" alt="アイコン画像">
      @else
          <img class="user-img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
      @endif
</div>

<div id="app" class="container">
    <div   class="row">

      <h2 class="secondary-title margin-bottom-space_l">

        @if(($user->username)  != null)
            {{$user->username}}さんのマイページ
        @else
            [ユーザー名未設定]さんのマイページ
        @endif

      </h2>

      <h2 class="secondary-title margin-bottom-space_l">登録したSTEP一覧</h2>
        <div class="individual-step-group">

            @foreach ($my_create_steps as $my_create_step)

                  <div class="individual-step margin-bottom-space_l bg-white border-default">
                      <a class="step-link" href="{{ action('StepsController@show', $my_create_step->id) }}">
                        @if(($my_create_step->pic) != null)
                          <div>
                            <img class="step-img" src="/{{ str_replace('public', 'storage', $my_create_step->pic) }}" alt="ステップ画像">
                          </div>
                        @else
                          <div>
                            <img class="step-img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                          </div>
                        @endif
                        <div class="step-body">
                            <span class="underline-thin">タイトル</span>
                            <p>{{ $my_create_step->title }}</p>
                            <span class="underline-thin">カテゴリー</span>
                            <p>{{ $my_create_step->category->category_name }}</p>
                            <span class="underline-thin">達成目安時間</span>
                            <p>{{ $my_create_step->goal_time }}時間</p>
                        </div>
                      </a>
                  </div>


              @endforeach
        </div>

        <h2 class="secondary-title margin-bottom-space_l ">チャレンジ中STEP一覧</h2>

        <div class="individual-step-group">
          @if(isset($my_challenge_steps[0]))
            @foreach ($my_challenge_steps as $my_challenge_step)

              <div class="individual-step margin-bottom-space_l bg-white border-default">
                  <a class="step-link" href="{{ action('ChallengeController@show', $my_challenge_step->id) }}">
                    @if(($my_challenge_step->parentStep['pic']) != null)
                      <div>
                        <img class="step-img" src="/{{ str_replace('public', 'storage', $my_challenge_step->parentStep['pic']) }}" alt="ステップ画像">
                      </div>
                    @else
                      <div>
                        <img class="step-img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                      </div>
                    @endif
                    <div class="step-body-challenging">
                        <span class="underline-thin">タイトル</span>
                        <p>{{ $my_challenge_step->parentStep['title']}}</p>
                        <span class="underline-thin">カテゴリー</span>
                        <p>{{ $my_challenge_step->parentStep->category['category_name'] }}</p>
                        <span class="underline-thin">達成目安時間</span>
                        <p>{{ $my_challenge_step->parentStep['goal_time'] }}時間</p>
                        <span class="underline-thin">かかった時間</span>
                        <p>{{ $my_challenge_step['total_time'] }}時間</p>
                        <span class="underline-thin">進捗状況</span>
                        <p>全5STEP中{{$my_challenge_step['num_clear_child_step']}}STEPクリア！</p>
                    </div>
                  </a>
              </div>

            @endforeach
          @endif

        </div>

        <h2 class="secondary-title margin-bottom-space_l">クリアしたSTEP一覧</h2>

        <div class="individual-step-group">
          @if(isset($my_finish_steps[0]))
            @foreach ($my_finish_steps as $my_finish_step)

              <div class="individual-step  margin-bottom-space_l bg-white border-default">
                <a class="step-link" href="{{ action('StepsController@show', $my_finish_step->parent_step_id) }}">

                    @if(($my_finish_step->parentStep['pic']) != null)
                      <div>
                        <img class="step-img" src="/{{ str_replace('public', 'storage', $my_finish_step->parentStep['pic']) }}" alt="ステップ画像">
                      </div>
                    @else
                      <div>
                        <img class="step-img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                      </div>
                    @endif
                    <div class="step-body-cleared">
                        <span class="underline-thin">タイトル</span>
                        <p>{{ $my_finish_step->parentStep['title']}}</p>
                        <span class="underline-thin">カテゴリー</span>
                        <p>{{ $my_finish_step->parentStep->category['category_name'] }}</p>
                        <span class="underline-thin">達成目安時間</span>
                        <p>{{ $my_finish_step->parentStep['goal_time'] }}時間</p>
                        <span class="underline-thin">かかった時間</span>
                        <p>{{ $my_finish_step['total_time'] }}時間</p>
                    </div>
                </a>
              </div>

            @endforeach
          @endif

        </div>

      </div>
</div>

@endsection
