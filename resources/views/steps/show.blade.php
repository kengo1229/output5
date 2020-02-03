@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('STEP詳細') }}</div>

                    <p>
                      @if(($user->username)  != null)
                        投稿者：{{$user->username}}
                      @else
                        投稿者：[ユーザー名未設定]
                      @endif
                      @if(($user->pic) != null)
                        <div>
                          <img src="/{{ str_replace('public/', 'storage/', $user->pic) }}" alt="アイコン画像" width="200" height="130">
                        </div>
                      @else
                        <div>
                          <img src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし" width="200" height="130">
                        </div>
                      @endif
                    </p>
                    <p>タイトル：{{ $parent_step->title }}</p>
                    <p>カテゴリー：{{ $parent_step->category->category_name }}</p>
                    <p>達成目安時間：{{ $parent_step->goal_time }}時間</p>
                    <p>内容：{{ $parent_step->description }}</p>
                    <p>子STEP一覧</p>
                    <a href="{{ action('StepsController@detail', $parent_step->id) }}">
                      子STEP詳細はこちら
                    </a>
                    @for ($i = 1; $i <= 5; $i++)
                    <div class="card-body text-center">
                      <p>子STEP{{ $i }}：{{ $child_step[$i - 1]['step']}}</p>
                    </div>
                    @endfor

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                          <a href="{{ action('ChallengeController@create', $parent_step->id) }}">
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
