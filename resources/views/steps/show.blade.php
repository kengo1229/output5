@php
$title = $parent_step->title.'の親STEP詳細';
@endphp

@extends('layouts.app')

<!-- @section('title')
{{ $parent_step->title }}の親STEP詳細
@endsection -->

@section('content')
    <div class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">{{ __('親STEP詳細') }}</div>

            <div class="p-card__body">

                <div class="c-post-user u-margin-bottom-space_m">
                    @if(($user->pic) != null)
                    <img class="c-post-user__img" src="{{ $user->pic }}" alt="アイコン画像">
                    @else
                    <img class="c-post-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    @endif
                    @if(($user->username) != null)
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：{{$user->username}}
                    </a>
                    @else
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：[ユーザー名未設定]
                    </a>
                    @endif
                </div>

                <a href="https://twitter.com/share?url=https://webukatustep.herokuapp.com/steps/{{ $parent_step->id }}&text={{ $parent_step->title }}@php echo urlencode('| 共有型学習支援サービス「STEP」')@endphp%0a&hashtags=@php echo urlencode('あなたの人生のSTEPを共有しよう')@endphp" data-show-count="false" target="_blank">
                  <span class="u-twitter-share-btn"><i class="fab fa-twitter"></i> Tweet</span>
                </a>

                <div class="p-show">
                    <div class="p-show__group">
                        <p class="u-underline-thin">タイトル</p>
                        <p class="p-show__control u-underline-bold">{{ $parent_step->title }}</p>
                    </div>

                    <div class="p-show__group">
                        <p class="u-underline-thin">カテゴリー</p>
                        <p class="p-show__control u-underline-bold">{{ $parent_step->category->category_name }}</p>
                    </div>

                    <div class="p-show__group">
                        <p class="u-underline-thin">達成目安時間</p>
                        <p class="p-show__control u-underline-bold">{{ $parent_step->goal_time }}時間</p>
                    </div>

                    <div class="p-show__group">
                        <p class="u-underline-thin">内容</p>
                        <div class="p-show__control u-underline-bold">{{ $parent_step->description }}</div>
                    </div>

                    <div class="p-show__group  u-underline-bold">
                        <p class="u-underline-thin">子STEP一覧
                          <a class="p-show__link" href="{{ action('StepsController@detail', $parent_step->id) }}">
                            子STEP詳細はこちら
                          </a>

                        </p>
                        @for ($i = 1; $i <= 5; $i++)
                        <div class="p-show__control">
                            <div>子STEP{{ $i }}：{{ $child_step[$i - 1]['step']}}</div>
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="p-show__group">
                    <a href="{{ action('ChallengeController@create', $parent_step->id) }}">
                        <button type="submit" class="c-btn u-float-right">
                          チャレンジ
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
