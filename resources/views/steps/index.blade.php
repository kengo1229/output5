@extends('layouts.app')

@section('title', 'STEP一覧')

@section('content')
    <div class="container">

      <div id="app" class="row">
        <h2 class="u-secondary-title u-margin-bottom-space_l js-height-hold">STEP一覧</h2>
            <parent-steps-component></parent-steps-component>
      </div>

    </div>
@endsection
