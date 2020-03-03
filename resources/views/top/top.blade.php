@extends('layouts.app')

@section('title', 'TOP')

@section('top')

<section class="p-hero js-float-menu-target">
    <h2 class="p-hero__title js-height-hold js-float-menu-target ">さぁ、あなたの人生の<br>STEPを共有しよう</h2>
</section>

@endsection

@section('content')

<div class="c-container">
    <div id="app" class="c-row">
        <h2 class="u-secondary-title">新着STEP一覧</h2>
        <div class="c-step-group">
            @foreach ($latest_parent_steps as $latest_parent_step)

            <div class="p-step u-bg-white u-border-default ">
                <a class="p-step__link" href="{{ action('StepsController@show', $latest_parent_step->id) }}">
                    @if(($latest_parent_step->pic) != null)
                    <div>
                        <img class="p-step__img" src="{{ $latest_parent_step->pic }}" alt="ステップ画像">
                    </div>
                    @else
                    <div>
                        <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    </div>
                    @endif
                    <div class="p-step__body">
                        <p class="u-underline-thin">タイトル</p>
                        <p>{{ str_limit( $latest_parent_step->title, 46) }}</p>
                        <p class="u-underline-thin">カテゴリー</p>
                        <p>{{ $latest_parent_step->category->category_name }}</p>
                        <p class="u-underline-thin">達成目安時間</p>
                        <p>{{ $latest_parent_step->goal_time }}時間</p>
                    </div>
                </a>
            </div>

            @endforeach

        </div>
    </div>
</div>

@endsection
