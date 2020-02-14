@extends('layouts.app')

@section('title', 'チャレンジ')

@section('content')
    <div id="app" class="main-container js-height-hold">

          <div class="p-card u-bg-white u-border-default">

                <div class="p-card__header">
                  子STEP{{ $challenge_child_step_info->num_child_step }}：{{ $challenge_child_step_info->childStep->step }}
                </div>

                <div class="p-card__body">
                    <div class="p-show-group">
                        <div class="col-md-6">
                          <span class="u-underline-thin">やること</span>
                            <p id="title"  class="p-show__control u-underline-bold" >
                              {{ $challenge_child_step_info->childStep->todo }}
                            </p>
                        </div>
                    </div>

                    <!-- クリアボタンが押されたら現在表示されている子ステップのidを渡す -->
                      <form method="POST" action="{{ route('challenge.clear', $challenge_child_step_info->id) }}">
                          @csrf


                          <div class="p-form__group">
                            <label for="passed_time" class="col-md-4 col-form-label text-md-right">かかった時間</label>

                              <div class="col-md-6">
                                  <input id="passed_time" type="text" class="p-form__control p-form__time  @error('passed_time') u-is-invalid @enderror" name="passed_time" value="{{ old('passed_time') }}" autocomplete="passed_time" autofocus>時間

                                  @error('passed_time')
                                  <span class="u-invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="p-form__group">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="c-btn c-btn--primary u-float-right">
                                      クリア
                                  </button>
                              </div>
                          </div>

                      </form>


                </div>

                <div class="p-card__footer">
                  親STEP情報
                  <p><span class="u-underline-thin">タイトル</span>：{{ $parent_step_info->title }}</p>
                  <p><span class="u-underline-thin">カテゴリー</span>：{{ $parent_step_info->category->category_name }}</p>
                  <p><span class="u-underline-thin">投稿者</span>：{{ $parent_step_info->user->username }}</p>
                  <p><span class="u-underline-thin">達成目標時間</span>：{{ $parent_step_info->goal_time }}</p>
                  <p><span class="u-underline-thin">内容</span>：{{ $parent_step_info->description }}</p>

                </div>


          </div>
    </div>
@endsection
