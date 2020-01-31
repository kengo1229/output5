@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('子STEP詳細') }}</div>

                    @for ($i = 1; $i <= 5; $i++)
                    <div class="card-body text-center">
                      <p>子STEP{{ $i }}：{{ $child_step['step'.($i - 1)] }}</p>
                    </div>
                    <div class="card-body text-center">
                      <p>やること{{ $i }}：{{ $child_step['todo'.($i - 1)] }}</p>
                    </div>
                    @endfor

                    <a href="{{ action('StepsController@show', $child_step->parent_step_id) }}">
                      STEP詳細に戻る
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
