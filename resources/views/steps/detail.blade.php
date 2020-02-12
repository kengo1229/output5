@extends('layouts.app')

@section('title', '子STEP詳細')

@section('content')

    <div id="app" class="container js-height-hold">
        <div class="card bg-white border-default content-center">
            <div class="card-header">{{ __('子STEP詳細') }}</div>

            <div class="card-body">

              @for ($i = 1; $i <= 5; $i++)
                <div class="show-group row  underline-bold">
                    <div class="col-md-6">
                      <span class="underline-thin">子STEP{{ $i }}</span>
                        <div class="show-control">{{ $child_step[$i - 1]['step']}}</div>
                      <span class="underline-thin">やること</span>
                        <div class="show-control">{{ $child_step[$i - 1]['todo']}}</div>
                    </div>
                </div>
              @endfor

              <!-- 親STEPに紐づいた子STEPのparent_step_idは全て同一なので0番目の配列から取得 -->
              <a href="{{ action('StepsController@show', $child_step[0]->parent_step_id) }}">
                STEP詳細に戻る
              </a>
            </div>
        </div>
    </div>
@endsection
