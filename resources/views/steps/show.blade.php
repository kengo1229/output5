@extends('layouts.app')

@section('title', 'STEP詳細')

@section('content')
    <div class="container js-height-hold">
          <div id="app" class="card bg-white border-default">
              <div class="card-header">{{ __('STEP詳細') }}</div>


              <div class="card-body">

                <div class="post-user margin-bottom-space_m">
                  @if(($user->pic) != null)
                    <img class="post-user-img" src="/{{ str_replace('public/', 'storage/', $user->pic) }}" alt="アイコン画像" width="200" height="130">
                  @else
                    <img class="post-user-img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
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

                <div class="show-group row">
                    <div class="col-md-6 ">
                      <span class="underline-thin">タイトル</span>
                      <p class="show-control underline-bold">{{ $parent_step->title }}</p>
                    </div>
                </div>

                <div class="show-group row">
                    <div class="col-md-6">
                      <span class="underline-thin">カテゴリー</span>
                      <p class="show-control underline-bold">{{ $parent_step->category->category_name }}</p>
                    </div>
                </div>

                <div class="show-group row">
                    <div class="col-md-6">
                      <span class="underline-thin">達成目安時間</span>
                      <p class="show-control underline-bold">{{ $parent_step->goal_time }}時間</p>
                    </div>
                </div>

                <div class="show-group row">
                    <div class="col-md-6">
                      <span class="underline-thin">内容</span>
                      <p class="show-control underline-bold">{{ $parent_step->description }}</p>
                    </div>
                </div>

                <div class="show-group row  underline-bold">
                    <div class="col-md-6">

                      <span class="underline-thin">子STEP一覧
                        <a href="{{ action('StepsController@detail', $parent_step->id) }}">
                          子STEP詳細はこちら
                        </a>

                      </span>
                        @for ($i = 1; $i <= 5; $i++)
                        <div  class="show-control">
                          <div>子STEP{{ $i }}：{{ $child_step[$i - 1]['step']}}</div>
                        </div>
                        @endfor

                    </div>
                </div>

                <div class="show-group row">
                <div class="col-md-6 offset-md-4">
                  <a href="{{ action('ChallengeController@create', $parent_step->id) }}">
                    <button type="submit" class="btn btn-primary float-right">
                        チャレンジ
                    </button>
                  </a>
                </div>

          </div>

        </div>
    </div>
@endsection
