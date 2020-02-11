@extends('layouts.app')

@section('title', 'チャレンジ')

@section('content')
    <div id="app" class="container">

                <div class="card bg-white border-default">

                      <div class="card-header">
                        子STEP{{ $challenge_child_step_info->num_child_step }}：{{ $challenge_child_step_info->childStep->step }}
                      </div>

                      <div class="card-body">
                          <div class="show-group row">
                              <div class="col-md-6">
                                <span class="underline-thin">やること</span>
                                  <p id="title"  class="show-control underline-bold" >
                                    {{ $challenge_child_step_info->childStep->todo }}
                                  </p>
                              </div>
                          </div>

                          <!-- クリアボタンが押されたら現在表示されている子ステップのidを渡す -->
                            <form method="POST" action="{{ route('challenge.clear', $challenge_child_step_info->id) }}">
                                @csrf


                                <div class="form-group row">
                                  <label for="passed_time" class="col-md-4 col-form-label text-md-right">かかった時間</label>

                                    <div class="col-md-6">
                                        <input id="passed_time" type="text" class="form-control form-control-time  @error('passed_time') is-invalid @enderror" name="passed_time" value="{{ old('passed_time') }}" autocomplete="passed_time" autofocus>時間

                                        @error('passed_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary float-right">
                                            クリア
                                        </button>
                                    </div>
                                </div>

                            </form>


                      </div>

                      <div class="card-footer">
                        親STEP情報
                        <p>タイトル：{{ $parent_step_info->title }}</p>
                        <p>カテゴリー：{{ $parent_step_info->category->category_name }}</p>
                        <p>投稿者：{{ $parent_step_info->user->username }}</p>
                        <p>達成目標時間：{{ $parent_step_info->goal_time }}</p>
                        <p>内容：{{ $parent_step_info->description }}</p>

                      </div>


                </div>
    </div>
@endsection
