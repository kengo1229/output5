@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">STEP新規登録</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('steps.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">タイトル(40文字以内)</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">カテゴリー</label>

                                <div class="col-md-6">
                                    <select id="category_id" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id"  autocomplete="category_id" autofocus>
                                      <option  value="0">選択してください</option>
                                      @foreach($categories as $category )
                                      @if(old('category_id') == $category->id )
                                      <option value="{{ $category->id }}"  selected = "selcted" > {{ $category->category_name}} </option>
                                      @else
                                      <option value="{{$category->id}}"> {{ $category->category_name}} </option>
                                      @endif
                                      @endforeach
                                    </select>


                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="goal_time" class="col-md-4 col-form-label text-md-right">達成目安時間</label>

                                <div class="col-md-6">
                                    <input id="goal_time" type="text" class="form-control @error('goal_time') is-invalid @enderror" name="goal_time" value="{{ old('goal_time') }}" autocomplete="goal_time" autofocus>時間

                                    @error('goal_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">説明(200文字以内)</label>

                                <div class="col-md-6">
                                    <input id="description" type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                                @for ($i = 1; $i <= 5; $i++)
                                  <div class="form-group row">

                                    <label for="step{{$i - 1}}" class="col-md-4 col-form-label text-md-right">{{ __('子STEP').$i }} </label>

                                    <div class="col-md-6">
                                      <input id="step{{$i - 1}}" type="text" class="form-control  @error('step'.($i - 1)) is-invalid @enderror" name="step{{$i - 1}}" value="{{ old('step'.($i - 1)) }} " autocomplete="step{{$i - 1}}" autofocus>

                                      @error('step'.($i - 1))
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>

                                    <label for="todo{{$i - 1}}" class="col-md-4 col-form-label text-md-right">やること(100文字以内) </label>

                                    <div class="col-md-6">
                                        <input id="todo{{$i - 1}}" type="textarea" class="form-control @error('todo'.($i - 1)) is-invalid @enderror" name="todo{{$i - 1}}" value="{{ old('todo'.($i - 1)) }}" autocomplete="todo{{$i - 1}}" autofocus>

                                        @error('todo'.($i - 1))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                  </div>

                                @endfor





                            <div class="form-group row">
                                <label for="pic" class="col-md-4 col-form-label text-md-right">画像：任意</label>

                                <div class="col-md-6">

                                    <input id="pic" type="file" class="form-control @error('category_name') is-invalid @enderror" name="pic" value="{{ old('pic') }}" autocomplete="pic" autofocus>

                                    @error('pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        登録
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
