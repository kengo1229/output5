@php
$title = 'クリアSTEP詳細';
@endphp

@extends('layouts.app')

@section('content')
    <div id="app" class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">クリアSTEP詳細</div>

            <div class="p-card__body">

                <div class="c-post-user u-margin-bottom-space_m">
                    @if(($finish_parent_step->user->pic) != null)
                    <img class="c-post-user__img" src="{{ $finish_parent_step->user->pic }}" alt="アイコン画像">
                    @else
                    <img class="c-post-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    @endif
                    @if(($finish_parent_step->user->username) != null)
                    <a href="{{ action('ProfileController@show', $finish_parent_step->user->id) }}">
                      投稿者：{{$finish_parent_step->user->username}}
                    </a>
                    @else
                    <a href="{{ action('ProfileController@show', $finish_parent_step->user->id) }}">
                      投稿者：[ユーザー名未設定]
                    </a>
                    @endif
                </div>

                <div class="p-show">
                  @csrf

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">タイトル</p>
                          <div class="p-show__control">{{ $finish_parent_step->title }}</div>
                        </div>
                    </div>

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">カテゴリー</p>
                          <div class="p-show__control">{{ $finish_parent_step->category->category_name }}</div>
                        </div>
                    </div>

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">達成目安時間</p>
                          <div class="p-show__control">{{ $finish_parent_step->goal_time }}時間</div>
                        </div>
                    </div>

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">かかった時間</p>
                          <div class="p-show__control">{{ $finish_parent_step->total_time }}時間</div>
                        </div>
                    </div>

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">内容</p>
                          <div class="p-show__control">{{ $finish_parent_step->description }}</div>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                    @if(isset($finish_child_step[$i - 1]['step']) && isset($finish_child_step[$i - 1]['todo']))

                    <div class="p-show__group u-underline-bold">
                        <div>
                          <p class="u-underline-thin">{{__('子STEP').$i}}</p>
                          <div class="p-show__control">{{ $finish_child_step[$i - 1]['step'] }}</div>
                        </div>
                        <div>
                          <p class="u-underline-thin">やること</p>
                          <div class="p-show__control">{{ $finish_child_step[$i - 1]['todo'] }}</div>
                        </div>
                    </div>

                    @endif
                    @endfor

                </div>
            </div>
        </div>
    </div>
@endsection
