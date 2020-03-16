@php
$title = 'STEP編集';
@endphp

@extends('layouts.app')

@section('content')
    <div id="app" class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">STEP編集@if($challenge_flg)（チャレンジ中のため編集できません。）@endif</div>
            <?php var_dump($challenge_flg) ?>
            <div class="p-card__body">

                <div class="c-post-user u-margin-bottom-space_m">
                    @if(($user->pic) != null)
                    <img class="c-post-user__img" src="{{ $user->pic }}" alt="アイコン画像">
                    @else
                    <img class="c-post-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                    @endif
                    @if(($user->username) != null)
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：{{$user->username}}
                    </a>
                    @else
                    <a href="{{ action('ProfileController@show', $user->id) }}">
                      投稿者：[ユーザー名未設定]
                    </a>
                    @endif
                </div>

                <form class="p-form" method="POST" action="{{ route('steps.update', $parent_step_info->id) }}" enctype="multipart/form-data">
                  @csrf

                    <a href="/explanation/post">編集方法はこちら</a>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>タイトル</p>
                        <div id="title" type="text" class="p-form__control">{{ $parent_step_info->title }}</div>
                        @else
                        <label for="title">タイトル(40文字以下)<span class="c-badge">必須</span></label>
                        <input id="title" type="text" class="p-form__control js-count1 @error('title') u-is-invalid @enderror" name="title" value="{{ old('title', $parent_step_info->title) }}" autocomplete="title" autofocus>
                        <p class="u-float-right"><span class="js-show1">0</span>/40</p>
                        @error('title')
                        <p class="u-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        @endif
                    </div>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>カテゴリー</p>
                        <div class="p-form__control p-form__category">{{ $parent_step_info->category->category_name }}</div>
                        @else
                        <label for="category_id">カテゴリー<span class="c-badge">必須</span></label>
                        <div>
                            <select id="category_id" type="text" class="p-form__control p-form__category @error('category_id') u-is-invalid @enderror" name="category_id" autocomplete="category_id" autofocus>
                            @foreach($categories as $category )
                                @if($category->id == $parent_step_info->category_id )
                                    <option value="{{ $category->id }}" selected="selcted"> {{ $category->category_name}} </option>
                                @elseif(old('category_id') == $category->id )
                                    <option value="{{$category->id}}" selected="selcted"> {{ $category->category_name}} </option>
                                @else
                                    <option value="{{$category->id}}"> {{ $category->category_name}} </option>
                                @endif
                            @endforeach
                            </select>
                            @error('category_id')
                            <p class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>達成目安時間</p>
                        <div class="p-form__control p-form__time">{{ $parent_step_info->goal_time }}</div>
                        @else
                        <label for="goal_time">達成目安時間<span class="c-badge">必須</span></label>
                        <div>
                            <input id="goal_time" type="text" class="p-form__control p-form__time @error('goal_time') u-is-invalid @enderror" name="goal_time" value="{{ old('goal_time', $parent_step_info->goal_time) }}" autocomplete="goal_time" autofocus>時間

                            @error('goal_time')
                            <p class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>内容</p>
                        <div class="p-form__control p-form__textarea">{{ $parent_step_info->description }}</div>
                        @else
                        <label for="description">内容(200文字以下)<span class="c-badge">必須</span></label>

                        <textarea id="description" class="p-form__control p-form__textarea js-count2 @error('description') u-is-invalid @enderror" name="description" autocomplete="description" autofocus>{{ old('description', $parent_step_info->description) }}</textarea>
                        <p class="u-float-right"><span class="js-show2">0</span>/200</p>

                        @error('description')
                        <p class="u-invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        @endif
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>{{__('子STEP').$i}}</p>
                        <div class="p-form__control">{{ $child_step_info[$i - 1]['step'] }}</div>
                        @else
                        <label for="step{{$i - 1}}">{{__('子STEP').$i}}<span class="c-badge">@if($i === 1)必須@else任意@endif</span></label>

                        <input id="step{{$i - 1}}" type="text" class="p-form__control js-count{{$i + 2}} @error('step'.($i - 1)) u-is-invalid @enderror" name="step{{$i - 1}}" value="@if(isset($child_step_info[$i - 1]['step'])){{old('step'.($i - 1),$child_step_info[$i - 1]['step'])}}@else{{old('step'.($i - 1))}}@endif" autocomplete="step{{$i - 1}}" autofocus>
                        <p class="u-float-right"><span class="js-show{{$i + 2}}">0</span>/40</p>

                        @error('step'.($i - 1))
                        <p class="u-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        @endif

                    </div>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        <p>やること</p>
                        <div class="p-form__control p-form__textarea">{{ $child_step_info[$i - 1]['todo'] }}</div>
                        @else
                        <label for="todo{{$i - 1}}">やること(100文字以下)<span class="c-badge">@if($i === 1)必須@else任意@endif</span></label>

                        <textarea id="todo{{$i - 1}}" class="p-form__control p-form__textarea js-count{{$i + 7}} @error('todo'.($i - 1)) u-is-invalid @enderror" name="todo{{$i - 1}}" autocomplete="todo{{$i - 1}}" autofocus>@if(isset($child_step_info[$i - 1]['todo'])){{ old('todo'.($i - 1), $child_step_info[$i - 1]['todo']) }}@else{{ old('todo'.($i - 1)) }}@endif</textarea>
                        <p class="u-float-right"><span class="js-show{{$i + 7}}">0</span>/100</p>

                        @error('todo'.($i - 1))
                        <p class="u-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        @endif
                    </div>

                    @endfor

                    <div class="p-form__group">
                        <p>登録した画像</p>

                        @if(($parent_step_info->pic) != null)
                        <div>
                            <img src="{{ $parent_step_info->pic }}" class="p-form__img" alt="ステップ画像">
                        </div>
                        @else
                        <div>
                            <img src="{{ asset('/img/no_image.jpg') }}" class="p-form__img" alt="登録画像なし">
                        </div>
                        @endif
                    </div>

                    <div class="p-form__group">
                        @if($challenge_flg)
                        @else
                        <label for="pic">新しい画像（jpg/jpeg/png）<span class="c-badge">任意</span></label>

                        <input id="pic" type="file" class="p-form__control p-form__pic @error('pic') u-is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                        @error('pic')
                        <p class="u-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                        @endif
                    </div>

                    <div class="p-form__group">
                      @if($challenge_flg)
                        <p>他ユーザーがチャレンジ中のため編集できません。</p>
                      @else
                        <button type="submit" class="c-btn u-float-right">
                          編集
                        </button>
                      @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
