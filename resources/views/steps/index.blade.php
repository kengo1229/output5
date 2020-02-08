@extends('layouts.app')

@section('content')
    <div class="container">
      <h2>STEP一覧</h2>
      <div id="app" class="row">
          <div class="col-sm-6">
            <parent-steps-component></parent-steps-component>
          </div>
          <steps-pagination-component></steps-pagination-component>
      </div>
    </div>
@endsection
