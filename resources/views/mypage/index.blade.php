@extends('layouts.app')

@section('title', 'マイページ')

@section('content')


<div class="p-user u-margin-bottom-space_l js-height-hold">

    @if(($user->pic) != null)
    <img class="p-user__img" src="{{ $user->pic }}" alt="アイコン画像">
    @else
    <img class="p-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
    @endif
</div>

<div id="app" class="c-container">
    <div class="c-row">

        <h2 class="u-secondary-title u-margin-bottom-space_l">

            @if(($user->username) != null)
            {{$user->username}}さんのマイページ
            @else
            [ユーザー名未設定]さんのマイページ
            @endif

        </h2>

        <h2 class="u-secondary-title u-margin-bottom-space_l">登録したSTEP一覧</h2>
        <div class="c-step-group  c-step-group--min-height">

            @foreach ($my_create_steps as $my_create_step)

            <div class="p-step  u-bg-white u-border-default">
                <a class="p-step__link" href="{{ action('StepsController@show', $my_create_step->id) }}">
                    @if(($my_create_step->pic) != null)
                    <div>
                        <img class="p-step__img" src="{{ $my_create_step->pic }}" alt="ステップ画像">
                    </div>
                    @else
                    <div>
                        <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    </div>
                    @endif
                    <div class="p-step__body">
                        <p class="u-underline-thin">タイトル</p>
                        <p>{{ str_limit( $my_create_step->title, 46) }}</p>
                        <p class="u-underline-thin">カテゴリー</p>
                        <p>{{ $my_create_step->category->category_name }}</p>
                        <p class="u-underline-thin">達成目安時間</p>
                        <p>{{ $my_create_step->goal_time }}時間</p>
                    </div>
                </a>
            </div>

            @endforeach
        </div>

        <h2 class="u-secondary-title u-margin-bottom-space_l ">チャレンジ中STEP一覧</h2>

        <div class="c-step-group c-step-group--min-height">
            @if(isset($my_challenge_steps[0]))
            @foreach ($my_challenge_steps as $my_challenge_step)

            <div class="p-step u-margin-bottom-space_l u-bg-white u-border-default">
                <a class="p-step__link" href="{{ action('ChallengeController@show', $my_challenge_step->id) }}">
                    @if(($my_challenge_step->parentStep['pic']) != null)
                    <div>
                        <img class="p-step__img" src="{{ $my_challenge_step->parentStep['pic'] }}" alt="ステップ画像">
                    </div>
                    @else
                    <div>
                        <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    </div>
                    @endif
                    <div class="p-step__body-challenging">
                        <p class="u-underline-thin">タイトル</p>
                        <p>{{ str_limit( $my_challenge_step->parentStep['title'], 46) }}</p>
                        <p class="u-underline-thin">カテゴリー</p>
                        <p>{{ $my_challenge_step->parentStep->category['category_name'] }}</p>
                        <p class="u-underline-thin">達成目安時間</p>
                        <p>{{ $my_challenge_step->parentStep['goal_time'] }}時間</p>
                        <p class="u-underline-thin">かかった時間</p>
                        <p>{{ $my_challenge_step['total_time'] }}時間</p>
                        <p class="u-underline-thin">進捗状況</p>
                        <p>5STEP中{{$my_challenge_step['num_clear_child_step']}}STEPクリア</p>
                    </div>
                </a>
            </div>

            @endforeach
            @endif

        </div>

        <h2 class="u-secondary-title u-margin-bottom-space_l">クリアしたSTEP一覧</h2>

        <div class="c-step-group c-step-group--min-height">
            @if(isset($my_finish_steps[0]))
            @foreach ($my_finish_steps as $my_finish_step)

            <div class="p-step  u-margin-bottom-space_l u-bg-white u-border-default">
                <a class="p-step__link" href="{{ action('StepsController@show', $my_finish_step->parent_step_id) }}">

                    @if(($my_finish_step->parentStep['pic']) != null)
                    <div>
                        <img class="p-step__img" src="{{ $my_finish_step->parentStep['pic'] }}" alt="ステップ画像">
                    </div>
                    @else
                    <div>
                        <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    </div>
                    @endif
                    <div class="p-step__body-cleared">
                        <p class="u-underline-thin">タイトル</p>
                        <p>{{ str_limit( $my_finish_step->parentStep['title'], 46) }}</p>
                        <p class="u-underline-thin">カテゴリー</p>
                        <p>{{ $my_finish_step->parentStep->category['category_name'] }}</p>
                        <p class="u-underline-thin">達成目安時間</p>
                        <p>{{ $my_finish_step->parentStep['goal_time'] }}時間</p>
                        <p class="u-underline-thin">かかった時間</p>
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
