@php
$title = '500エラー';
@endphp

@extends('layouts.app')

@section('content')

<div class="p-error">

  <p class="p-error__main-message">ページが見つかりませんでした。</p>
  <p class="p-error__sub-message">お探しのページはアドレスが間違っているか、</p>
  <p class="p-error__sub-message">削除された可能性があります。</p>

</div>

@endsection
