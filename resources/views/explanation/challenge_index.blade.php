@php
$title = 'STEPチャレンジ説明';
@endphp

@extends('layouts.app')

@section('content')

<div class="c-container">
    <div id="app" class="c-row">

        <div class="p-explanation">
            <h1 class="p-explanation__main-title">チャレンジ方法</h1>
            <div class="p-explanation__content">
              <div class="p-howTo">
                  <h2 class="p-howTo__head">① チャレンジしたいSTEPクリックする</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo10.png') }}" alt="STEPチャレンジ方法01">
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo11.png') }}" alt="STEPチャレンジ方法02">
                  <p class="p-howTo__sentence">チャレンジしたいSTEPは「STEP一覧」から選んでください</p>
                  <p class="p-howTo__sentence">※自分が登録したSTEPにはチャレンジできません(編集ページに移ります)</p>
              </div>
              <div class="p-howTo">
                  <h2 class="p-howTo__head">② 親STEP詳細画面の「チャレンジ」をクリックする</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo12.png') }}" alt="STEPチャレンジ方法03">
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo13.png') }}" alt="STEPチャレンジ方法04">
                  <p class="p-howTo__sentence">クリックするとチャレンジ画面に移ります</p>
              </div>
              <div class="p-howTo">
                  <h2 class="p-howTo__head">③ 子STEPのやることにかかった時間を入力する</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo14.png') }}" alt="STEPチャレンジ方法05">
                  <p class="p-howTo__sentence">整数で入力してください</p>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo19.png') }}" alt="STEPチャレンジ方法06">
                  <p class="p-howTo__sentence">「中断する」をクリックするとチャレンジが中断し、マイページに移ります</p>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo20.png') }}" alt="STEPチャレンジ方法07">
                  <p class="p-howTo__sentence">チャレンジ中のSTEPはマイページから確認できますクリックするとチャレンジが再開します</p>
              </div>
              <div class="p-howTo">
                  <h2 class="p-howTo__head">④ 「クリア」をクリックする</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo15.png') }}" alt="STEPチャレンジ方法08">
                  <p class="p-howTo__sentence">クリックすると次の子STEP画面に移ります（子STEPが１つの場合は終了となります）</p>
              </div>
              <div class="p-howTo">
                  <h2 class="p-howTo__head">⑤ 子STEPを全てクリアするとマイページに移ります</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo16.png') }}" alt="STEPチャレンジ方法09">
              </div>
              <div class="p-howTo">
                  <h2 class="p-howTo__head">⑥ クリアしたSTEPをクリックすると詳細情報が見れます</h2>
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo17.png') }}" alt="STEPチャレンジ方法10">
                  <img  class="p-howTo__img" src="{{ asset('/img/howTo18.png') }}" alt="STEPチャレンジ方法11">
              </div>

            </div>

            @guest
            <a class="p-explanation__link" href="/register">
                <div class="p-explanation__button">会員登録してSTEPにチャレンジしてみる</div>
            </a>
            @endguest

        </div>

    </div>
</div>

@endsection
