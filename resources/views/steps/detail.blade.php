@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('子STEP詳細') }}</div>

                    @for ($i = 1; $i <= 5; $i++)
                    <div class="card-body text-center">
                      <p>子STEP{{ $i }}：{{ $child_step[$i - 1]['step'] }}</p>
                    </div>
                    <div class="card-body text-center">
                      <p>やること：{{ $child_step[$i - 1]['todo'] }}</p>
                    </div>
                    @endfor
                    <!-- 親STEPに紐づいた子STEPのparent_step_idは全て同一なので0番目の配列から取得 -->
                    <a href="{{ action('StepsController@show', $child_step[0]->parent_step_id) }}">
                      STEP詳細に戻る
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
