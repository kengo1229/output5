@php
$title = 'STEP登録説明';
@endphp

@extends('layouts.app')

@section('content')

<div class="c-container">
    <div id="app" class="c-row">

        <div class="p-explanation">
            <h1 class="p-explanation__main-title">STEP登録（編集）方法</h1>
            <div class="p-explanation__content">
                <div class="p-howTo">
                    <h2 class="p-howTo__head">① ナビメニューの「STEP登録」をクリックする</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo01.png') }}" alt="STEP登録方法01">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">②フォームの各項目を入力する</h2>
                    <p class="p-howTo__sentence">子STEPとやることはセットで入力してください</p>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo02.png') }}" alt="STEP登録方法02">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">③ 入力したら「登録」をクリックする</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo03.png') }}" alt="STEP登録方法03">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">④ これでSTEP登録は完了です</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo04.png') }}" alt="STEP登録方法04">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">⑤ 登録したSTEPをクリックすると編集ページに飛びます</h2>
                    <p class="p-howTo__sentence">登録したSTEPはマイページから確認できます</p>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo05.png') }}" alt="STEP登録方法05">
                    <p class="p-howTo__sentence">※登録したSTEPに他ユーザーがチャレンジ中の場合、編集できません</p>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo06.png') }}" alt="STEP登録方法06">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">⑥ 入力内容を修正する</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo07.png') }}" alt="STEP登録方法07">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">⑦ 修正したら「編集」をクリックする</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo08.png') }}" alt="STEP登録方法08">
                </div>
                <div class="p-howTo">
                    <h2 class="p-howTo__head">⑧ これでSTEP編集は完了です</h2>
                    <img  class="p-howTo__img" src="{{ asset('/img/howTo09.png') }}" alt="STEP登録方法09">
                </div>
            </div>

            @guest
            <a class="p-explanation__link" href="/register">
                <div class="p-explanation__button">会員登録してSTEPを登録してみる！</div>
            </a>
            @endguest

        </div>

    </div>
</div>

@endsection
