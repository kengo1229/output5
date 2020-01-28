@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>STEP一覧</h2>
      <div class="row">

        @foreach ($index_step_info as $one_step_info)

        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">{{ $one_step_info-> title }}</h3>
            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>
@endsection
