@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('STEP詳細') }}</div>
                    <p>タイトル：{{ $parent_step->title }}</p>
                    <p>カテゴリー：{{ $parent_step->category->category_name }}</p>
                    <p>達成目安時間：{{ $parent_step->goal_time }}時間</p>
                    <p>内容：{{ $parent_step->description }}</p>
                    @for ($i = 1; $i <= 5; $i++)
                    <div class="card-body text-center">
                      <p>STEP{{ $i }}：{{ $child_step['step'.($i - 1)] }}</p>
                      <p>やること：{{ $child_step['todo'.($i - 1)] }}</p>
                    </div>
                    @endfor

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <a href="">
                            <button type="submit" class="btn btn-primary">
                                チャレンジ
                            </button>
                          </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
