@php
$title = $parent_step->title.'の子STEP詳細';
@endphp

@extends('layouts.app')

@section('title', '子STEP詳細')

@section('content')

    <div id="app" class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">{{ __('子STEP詳細') }}</div>

            <div class="p-card__body">
                <div class="p-show">
                    @foreach($child_steps as $index => $child_step)
                    @if($child_step['step'] !=null && $child_step['todo'] !=null)
                    <div class="p-show__group u-underline-bold">
                        <div>
                            <p class="u-underline-thin">子STEP{{ $index + 1 }}</p>
                            <div class="p-show__control">{{ $child_step['step']}}</div>
                            <p class="u-underline-thin">やること</p>
                            <div class="p-show__control">{{ $child_step['todo']}}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

            <!-- 親STEPに紐づいた子STEPのparent_step_idは全て同一なので配列の0番目から取得 -->
            <a href="{{ action('StepsController@show', $child_steps[0]->parent_step_id) }}">
            STEP詳細に戻る
            </a>
            </div>
        </div>
    </div>
@endsection
