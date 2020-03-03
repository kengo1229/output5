@extends('layouts.app')

@section('title', '子STEP詳細')

@section('content')

    <div id="app" class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">{{ __('子STEP詳細') }}</div>

            <div class="p-card__body">
                <div class="p-show">
                    @for ($i = 1; $i <= 5; $i++)
                    <div class="p-show__group  u-underline-bold">
                        <div>
                            <p class="u-underline-thin">子STEP{{ $i }}</p>
                            <div class="p-show__control">{{ $child_step[$i - 1]['step']}}</div>
                            <p class="u-underline-thin">やること</p>
                            <div class="p-show__control">{{ $child_step[$i - 1]['todo']}}</div>
                        </div>
                    </div>
                    @endfor
                </div>

            <!-- 親STEPに紐づいた子STEPのparent_step_idは全て同一なので配列の0番目から取得 -->
            <a href="{{ action('StepsController@show', $child_step[0]->parent_step_id) }}">
            STEP詳細に戻る
            </a>
            </div>
        </div>
    </div>
@endsection
