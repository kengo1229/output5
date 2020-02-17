@extends('layouts.app')

@section('title', 'STEP詳細')

@section('content')
    <div class="u-display-flex-center js-height-hold">
          <div  class="p-card u-bg-white u-border-default">
              <div class="p-card__header">{{ __('STEP詳細') }}</div>


              <div class="p-card__body">

                <div class="c-post-user u-margin-bottom-space_m">
                  @if(($user->pic) != null)
                    <img class="c-post-user__img" src="{{ $user->pic }}" alt="アイコン画像">
                  @else
                    <img class="c-post-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                  @endif
                  @if(($user->username)  != null)
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：{{$user->username}}
                    </a>
                  @else
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：[ユーザー名未設定]
                    </a>
                  @endif
                </div>

                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                <div class="p-show-group">
                    <div class="col-md-6 ">
                      <span class="u-underline-thin">タイトル</span>
                      <p class="p-show__control u-underline-bold">{{ $parent_step->title }}</p>
                    </div>
                </div>

                <div class="p-show-group">
                    <div class="col-md-6">
                      <span class="u-underline-thin">カテゴリー</span>
                      <p class="p-show__control u-underline-bold">{{ $parent_step->category->category_name }}</p>
                    </div>
                </div>

                <div class="p-show-group">
                    <div class="col-md-6">
                      <span class="u-underline-thin">達成目安時間</span>
                      <p class="p-show__control u-underline-bold">{{ $parent_step->goal_time }}時間</p>
                    </div>
                </div>

                <div class="p-show-group">
                    <div class="col-md-6">
                      <span class="u-underline-thin">内容</span>
                      <div class="p-show__control u-underline-bold">{{ $parent_step->description }}</div>
                    </div>
                </div>

                <div class="p-show-group  u-underline-bold">
                    <div class="col-md-6">

                      <span class="u-underline-thin">子STEP一覧
                        <a class="p-show-group__link" href="{{ action('StepsController@detail', $parent_step->id) }}">
                          子STEP詳細はこちら
                        </a>

                      </span>
                        @for ($i = 1; $i <= 5; $i++)
                        <div  class="p-show__control">
                          <div>子STEP{{ $i }}：{{ $child_step[$i - 1]['step']}}</div>
                        </div>
                        @endfor

                    </div>
                </div>

                <div class="p-show-group">
                <div class="col-md-6 offset-md-4">
                  <a href="{{ action('ChallengeController@create', $parent_step->id) }}">
                    <button type="submit" class="c-btn c-btn--primary u-float-right">
                        チャレンジ
                    </button>
                  </a>
                </div>

          </div>

        </div>
    </div>
@endsection
