<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\ChallengeChildStep;

class MypageController extends Controller
{

  // マイページ表示機能
  public function index($id) {

    // ログインユーザーのidがGETパラメーターの数字と一致する場合のみマイページを表示する
    if($id != Auth::id()){
        return redirect('/')->with('flash_message', __('不正な操作が行われました。'));
    }
    // ログインユーザーの情報取得
    $user = Auth::user();

    // 自分が登録したSTEPを最新のものから順に取得する
    $my_create_steps = ParentStep::with('category')->where('user_id', $id)->latest()->get();

    // 自分がチャレンジ中(end_flg = 0)のSTEPを最新のものから順に取得する
    // ２つのリレーション先のデータも一緒に取得する
    $my_challenge_steps = ChallengeParentStep::with(['parentStep' => function($query){
    $query->with('category');}])->where('user_id', $id)->where('end_flg', 0)->latest()->get();

    // 自分がチャレンジを終えたSTEPを最新のものから順に取得する
    $my_finish_steps = ChallengeParentStep::with(['parentStep' => function($query){
      $query->with('category');}])->where('user_id', $id)->where('end_flg', 1)->latest()->get();

    return view('mypage.index',compact('user', 'my_create_steps', 'my_challenge_steps', 'my_finish_steps'));
  }

}
