@php
$title = 'STEP一覧';
@endphp

@extends('layouts.app')

@section('content')
<div class="c-container">

    <div id="app" class="c-row">
        <h2 class="u-secondary-title u-margin-bottom-space_l js-height-hold">STEP一覧</h2>
        <parent-steps-component></parent-steps-component>
    </div>

</div>
@endsection
