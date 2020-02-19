@extends('layouts.app')

@section('title', 'STEP編集')

@section('content')
    <div id="app" class="u-display-flex-center js-height-hold">
        <div class="p-card u-bg-white u-border-default">
            <div class="p-card__header">STEP編集</div>


            <div class="p-card__body">

              <div class="c-post-user u-margin-bottom-space_m">
                @if(($user->pic) != null)
                  <img class="c-post-user__img" src="{{ $user->pic }}" alt="アイコン画像">
                @else
                  <img class="c-post-user__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                @endif
                @if(($user->username)  != null)
                  <a href="{{ action('ProfileController@show', $user->id) }}" class="c-post-user-name">
                    投稿者：{{$user->username}}
                  </a>
                @else
                  <a href="{{ action('ProfileController@show', $user->id) }}" class="c-post-user-name">
                    投稿者：[ユーザー名未設定]
                  </a>
                @endif
              </div>


                <form method="POST" action="{{ route('steps.update', $parent_step_info->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="p-form__group">
                        <label for="title" class="col-md-4">タイトル(40文字以下)<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="p-form__control js-count1 @error('title') u-is-invalid @enderror" name="title" value="{{ old('title', $parent_step_info->title) }}" autocomplete="title" autofocus>
                            <p class="u-float-right"><span class="js-show1">0</span>/40</p>

                            @error('title')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-form__group">
                        <label for="category_id" class="col-md-4">カテゴリー<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <select id="category_id" type="text" class="p-form__control p-form__category @error('category_id') u-is-invalid @enderror" name="category_id"  autocomplete="category_id" autofocus>
                              @foreach($categories as $category )
                              @if($category->id == $parent_step_info->category_id )
                              <option value="{{ $category->id }}"  selected = "selcted" > {{ $category->category_name}} </option>
                              @elseif(old('category_id') == $category->id )
                              <option value="{{$category->id}}" selected = "selcted"> {{ $category->category_name}} </option>
                              @else
                              <option value="{{$category->id}}"> {{ $category->category_name}} </option>
                              @endif
                              @endforeach
                            </select>

                            @error('category_id')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-form__group">
                        <label for="goal_time" class="col-md-4">達成目安時間<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <input id="goal_time" type="text" class="p-form__control  p-form__time @error('goal_time') u-is-invalid @enderror" name="goal_time" value="{{ old('goal_time', $parent_step_info->goal_time) }}" autocomplete="goal_time" autofocus>時間

                            @error('goal_time')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-form__group">
                        <label for="description" class="col-md-4">内容(200文字以下)<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <textarea id="description"  class="p-form__control p-form__textarea js-count2 @error('description') u-is-invalid @enderror" name="description"  autocomplete="description" autofocus>{{ old('description', $parent_step_info->description) }}</textarea>
                            <p class="u-float-right"><span class="js-show2">0</span>/200</p>

                            @error('description')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    @for ($i = 1; $i <= 5; $i++)
                      <div class="p-form__group">

                        <label for="step{{$i - 1}}" class="col-md-4">{{__('子STEP').$i}}<span class="c-badge">必須</span></label>

                        <div class="col-md-6">
                          <input id="step{{$i - 1}}" type="text" class="p-form__control js-count{{$i + 2}} @error('step'.($i - 1)) u-is-invalid @enderror" name="step{{$i - 1}}" value="{{old('step'.($i - 1),$child_step_info[$i - 1]['step'])}}" autocomplete="step{{$i - 1}}" autofocus>
                          <p class="u-float-right"><span class="js-show{{$i + 2}}">0</span>/40</p>

                          @error('step'.($i - 1))
                          <span class="u-invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="p-form__group">

                        <label for="todo{{$i - 1}}" class="col-md-4">やること(100文字以下)<span class="c-badge ">必須</span></label>

                        <div class="col-md-6">
                            <textarea id="todo{{$i - 1}}"  class="p-form__control p-form__textarea js-count{{$i + 7}} @error('todo'.($i - 1)) u-is-invalid @enderror" name="todo{{$i - 1}}"  autocomplete="todo{{$i - 1}}" autofocus>{{ old('todo'.($i - 1), $child_step_info[$i - 1]['todo']) }}</textarea>
                            <p class="u-float-right"><span class="js-show{{$i + 7}}">0</span>/100</p>

                            @error('todo'.($i - 1))
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    @endfor

                    <div class="p-form__group">
                        <p  class="col-md-4">登録した画像</p>

                        <div class="col-md-6">

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
                    </div>

                    <div class="p-form__group">
                        <label for="pic" class="col-md-4">新しい画像（jpg/jpeg/png）<span class="c-badge ">任意</span></label>

                        <div class="col-md-6">

                            <input id="pic" type="file" class="p-form__control p-form__pic @error('pic') u-is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                            @error('pic')
                            <span class="u-invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="p-form__group">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="c-btn c-btn--primary u-float-right">
                                編集
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
