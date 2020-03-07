@php
$title = 'あなたの人生のSTEPを共有しよう';
@endphp

@extends('layouts.app')

@section('top')

<section class="p-hero js-float-menu-target">
    <h1 class="p-hero__title js-height-hold js-float-menu-target ">あなたの人生の<br>STEPを共有しよう</h1>
</section>

@endsection

@section('content')

<div class="c-container">
    <div id="app" class="c-row">

        <div class="p-about js-fadeInUp">
            <h1 class="p-about__main-title">【About】 STEPとは？</h1>
            <div class="p-about__content">
              <h2 class="p-about__sub-title">最良の学習方法と順番がわかる それがSTEPです！！</h2>
                <p><span class="u-color-accent">新しく何かを始めたい</span>、けど<span class="u-color-accent">やり方がわからない...</span></p>
                <p>ネットで検索したけど大雑把な情報しか載っていない、そもそもできるようになるまでに<span class="u-color-accent">どれくらいの時間がかかるかわからないのは不安...</span></p>
                <p>個人のスキルアップが求められるようになった現代、こうした悩みは尽きません。</p>
                <p>ご安心ください。</p>
                <p><span class="u-color-accent">「STEP」</span>はそんな不安や悩みに応えた<span class="u-color-accent">共有型学習支援サービス</span>です。</p>
                <p>あなたはSTEPの「チャレンジ」を通して<span class="u-color-accent">効率的</span>かつ<span class="u-color-accent">無駄なく</span>学習を進め、<span class="u-color-accent">成長</span>していくことができます。</p>
            </div>

            <a class="p-about__link" href="/register">
                <div class="p-about__button">STEPに新規登録する</div>
            </a>

        </div>

        <div class="p-about js-fadeInUp">
          <h1 class="p-about__main-title--text-right">【Merit】 STEPの４つのメリット</h1>
            <div class="p-about__content js-showDelay">
                <h2 class="p-about__sub-title">１. 体験に基づいた学習方法</h2>
                <p>STEPでは<span class="u-color-accent">「この順番でこういったものを学んでいったのが良かった」</span>という体験に基づいた学習方法が投稿がされています。</p>
                <p>そのため、学習の順番とやることがしっかり決められています。</p>
                <p>1つのSTEPにはそれを達成するための子STEPが設定されていて、達成目安時間も設けられています。</p>
                <p>この通りに学習していけば、あなたは成長できます。</p>
            </div>
            <div class="p-about__content js-showDelay">
                <h2 class="p-about__sub-title">２. 幅広い投稿</h2>
                <p>プログラミングや外国語習得といったいわゆる「スキルアップ」系のジャンル、スポーツ、筋トレといった「肉体」系、お金、
                  恋愛、人間関係といった「お悩み解決」系のジャンルまで幅広く投稿されています。
                </p>
                <p>この他にも様々な投稿があり、<span class="u-color-accent">あなたの悩みや不安を解決するSTEPがきっと見つかります。</span></p>
            </div>
            <div class="p-about__content js-showDelay">
                <h2 class="p-about__sub-title">３. モチベーションの維持</h2>
                <p>STEPでは新規登録（無料）後にマイページが閲覧できるようになります。</p>
                <p>マイページでは現在自分が「チャレンジ」中のSTEPが一覧で見れるようになっていて、進捗状況が一目でわかります。</p>
                <p>また、過去にクリアしてきたSTEPも一覧表示されているので自分がどれだけ成長してきたのかがわかります。</p>
                <p><span class="u-color-accent">この見える化によってあなたの学習に対するモチベーションを維持します。</span></p>
            </div>
            <div class="p-about__content js-showDelay">
                <h2 class="p-about__sub-title">４. STEPの共有</h2>
                <p>「過去に自分はこのやり方と順番でこんなことができるようになった」 そんな体験を人に知ってもらって、できればやってみてもらいたくなる時ってありますよね。</p>
                <p>「STEP新規登録機能」を使えば自分のSTEPを投稿できます。投稿されたSTEPは他の人の学習を手助けします。</p>
                <p>さぁ、あなたの<span class="u-color-accent">人生</span>のSTEPを<span class="u-color-accent">共有</span>しましょう。</p>
            </div>

            <a class="p-about__link" href="/register">
                <div class="p-about__button js-showDelay">STEPに新規登録する</div>
            </a>

        </div>

        <div class="p-about js-fadeInUp">

            <h2 class="p-about__sub-title">新着STEP一覧</h2>
            <div class="c-step-group">
                @foreach ($latest_parent_steps as $latest_parent_step)

                <div class="p-step u-bg-white u-border-default ">
                    <a class="p-step__link" href="{{ action('StepsController@show', $latest_parent_step->id) }}">
                        @if(($latest_parent_step->pic) != null)
                        <div>
                            <img class="p-step__img" src="{{ $latest_parent_step->pic }}" alt="ステップ画像">
                        </div>
                        @else
                        <div>
                            <img class="p-step__img" src="{{ asset('/img/no_image.jpg') }}" alt="登録画像なし">
                        </div>
                        @endif
                        <div class="p-step__body">
                            <p class="u-underline-thin">タイトル</p>
                            <p>{{ str_limit( $latest_parent_step->title, 46) }}</p>
                            <p class="u-underline-thin">カテゴリー</p>
                            <p>{{ $latest_parent_step->category->category_name }}</p>
                            <p class="u-underline-thin">達成目安時間</p>
                            <p>{{ $latest_parent_step->goal_time }}時間</p>
                        </div>
                    </a>
                </div>

                @endforeach

            </div>
            <a class="u-float-right" href="/steps">他のSTEPも見てみる</a>
        </div>
    </div>
</div>

@endsection
