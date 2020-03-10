@php
$title = 'STEP新規登録';
@endphp

@extends('layouts.app')

@section('content')
<div id="app" class="u-display-flex-center js-height-hold">
    <div class="p-card u-bg-white u-border-default">
        <div class="p-card__header">STEP新規登録</div>

        <div class="p-card__body">
            <form class="p-form" method="POST" action="{{ route('steps.create') }}" enctype="multipart/form-data">
                @csrf

                <div class="p-form__group">
                    <label for="title">タイトル(40文字以下)<span class="c-badge">必須</span></label>

                    <div>
                        <input id="title" type="text" class="p-form__control js-count1 @error('title') u-is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>
                        <p class="u-float-right"><span class="js-show1">0</span>/40</p>

                        @error('title')
                        <p class="u-invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="p-form__group">
                    <label for="category_id">カテゴリー<span class="c-badge">必須</span></label>

                    <div>
                        <select id="category_id" type="text" size="1" class="p-form__control p-form__category @error('category_id') u-is-invalid @enderror" name="category_id" autocomplete="category_id" autofocus>
                            <option value="0">選択してください</option>
                            @foreach($categories as $category )
                            @if(old('category_id') == $category->id )
                            <option value="{{ $category->id }}" selected="selcted"> {{ $category->category_name}} </option>
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
                </div>

                <div class="p-form__group">
                    <label for="goal_time">達成目安時間<span class="c-badge">必須</span></label>

                    <div>
                        <input id="goal_time" type="text" class="p-form__control js-count p-form__time @error('goal_time') u-is-invalid @enderror" name="goal_time" value="{{ old('goal_time') }}" autocomplete="goal_time" autofocus>時間

                        @error('goal_time')
                        <p class="u-invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="p-form__group">
                    <label for="description">内容(200文字以下)<span class="c-badge">必須</span></label>

                    <div>
                        <textarea id="description" class="p-form__control p-form__textarea js-count2 @error('description') u-is-invalid @enderror" name="description" autocomplete="description" autofocus>{{ old('description') }}</textarea>
                        <p class="u-float-right"><span class="js-show2">0</span>/200</p>

                        @error('description')
                        <p class="u-invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </p>
                        @enderror
                    </div>
                </div>

                @for ($i = 1; $i <= 5; $i++)
                <div class="p-form__group">

                    <label for="step{{$i - 1}}">{{__('子STEP').$i }}(40文字以下)<span class="c-badge">@if($i === 1)必須@else任意@endif</span></label>

                    <input id="step{{$i - 1}}" type="text" class="p-form__control js-count{{$i + 2}} @error('step'.($i - 1)) u-is-invalid @enderror" name="step{{$i - 1}}" value="{{old('step'.($i - 1))}}" autocomplete="step{{$i - 1}}" autofocus>
                    <p class="u-float-right"><span class="js-show{{$i + 2}}">0</span>/40</p>

                    @error('step'.($i - 1))
                    <p class="u-invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">

                    <label for="todo{{$i - 1}}">やること(100文字以下)<span class="c-badge">@if($i === 1)必須@else任意@endif</span></label>

                    <textarea id="todo{{$i - 1}}" class="p-form__control p-form__textarea js-count{{$i + 7}} @error('todo'.($i - 1)) u-is-invalid @enderror" name="todo{{$i - 1}}" autocomplete="todo{{$i - 1}}" autofocus>{{ old('todo'.($i - 1)) }}</textarea>
                    <p class="u-float-right"><span class="js-show{{$i + 7}}">0</span>/100</p>

                    @error('todo'.($i - 1))
                    <p class="u-invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </p>
                    @enderror

                </div>

                @endfor

                <div class="p-form__group">
                    <label for="pic">画像（jpg/jpeg/png）<span class="c-badge">任意</span></label>

                    <input id="pic" type="file" class="p-form__control p-form__pic @error('category_name') u-is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                    @error('pic')
                    <p class="u-invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn  u-float-right">
                      登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
