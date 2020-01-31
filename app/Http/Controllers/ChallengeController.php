<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\Http\Requests\StepRequest;
use App\User;

class ChallengeController extends Controller
{
  // step新規登録画面の表示兼challenge_parent_stepsテーブルへの登録機能
  public function new($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
      return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    $parent_step = ParentStep::with('category')->find($id);

    // ログイン済みユーザーとstepを登録したユーザーが同じ場合、編集画面に飛ばす(自分で登録したSTEPにはチャレンジできない)
    if(($parent_step->user_id) === Auth::id()){
      return redirect()->route('steps.edit', ['id' => $parent_step->id]);
    }

    // challenge_parent_stepsテーブルにチャレンジ中のユーザーと親STEPを登録する
    ChallengeParentStep::create(['user_id' => Auth::id(), 'parent_step_id' => $parent_step->id]);

    // challenge_child_stepsテーブルにチャレンジ中の子STEPを登録する
    
    return view('challenge.new');
  }
}
