<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\ChallengeChildStep;
use App\Http\Requests\StepRequest;
use App\User;

class ChallengeController extends Controller
{
  /*
  チャレンジ画面の表示機能兼challenge_parent_stepsテーブルと
  challenge_parent_stepsテーブルへの登録機能
  */
  public function new($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
      return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    $parent_step = ParentStep::with('category')->find($id);

    /*
    ログイン済みユーザーとstepを登録したユーザーが同じ場合、
    編集画面に飛ばす(自分で登録したSTEPにはチャレンジできない）
    */
    if(($parent_step->user_id) === Auth::id()){
      return redirect()->route('steps.edit', ['id' => $parent_step->id]);
    }

    // challenge_parent_stepsテーブルにチャレンジ中のユーザーと親STEPの情報を登録する
    ChallengeParentStep::create(['user_id' => Auth::id(), 'parent_step_id' => $parent_step->id]);
    // challenge_parent_stepsテーブルから最新のidを変数に格納
    $challenge_parent_step_id = ChallengeParentStep::latest('id')->first()->id;

    // 親STEPに紐づいた子STEPのidを$idでまとめて取得する
    $child_step_id =  ChildStep::where('parent_step_id', $id)->get('id');
    // challenge_child_stepsにチャレンジ中の子STEP情報を登録する
    ChallengeChildStep::insert([
    ['challenge_parent_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[0]['id'] ],
    ['challenge_parent_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[1]['id'] ],
    ['challenge_parent_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[2]['id'] ],
    ['challenge_parent_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[3]['id'] ],
    ['challenge_parent_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[4]['id'] ]
]);

  return view('challenge.new');
  }
}
