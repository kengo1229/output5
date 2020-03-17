<?php

namespace App\Http\Controllers;


class ExplanationController extends Controller
{
  // SETP投稿説明画面を表示する
  public function postIndex() {

    return view('explanation.post_index');
  }

  // SETPチャレンジ説明画面を表示する
  public function challengeIndex() {

    return view('explanation.challenge_index');
  }
}
