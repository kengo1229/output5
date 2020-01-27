<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\ParentStep;
use App\ChildStep;
use App\Http\Requests\StepRequest;
use App\User;

class StepsController extends Controller
{
  // step新規登録画面の表示機能
  public function new()
  {
  // categoryテーブルの全ての値を取得して、ビューに渡す
    $categories = Category::get();

    return view('steps.new', ['categories' => $categories]);
  }

// フォームに入力された値のDB保存機能
  public function create(StepRequest $request)
  {
    // フォームに入力された値をparent_stepsに登録する
    $parent_step = new ParentStep;
    // ログインしているユーザーのidを格納する
    $parent_step->user_id = Auth::user()->id;
    $parent_step->fill($request->all())->save();

    // 最新のparent_stepsテーブルのidを変数に格納
    $parent_step_id = ParentStep::latest('id')->first()->id;

    // フォームに入力された値をchild_stepsに登録する
    $child_step = new ChildStep;
    $child_step->parent_step_id = $parent_step_id;
    $child_step->fill($request->all())->save();

    // stepの登録が完了したらホーム画面に飛ばす
    return redirect('/home')->with('flash_message', '登録が完了しました!');
  }

  // 登録したstep編集画面表示機能
  public function edit($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
        return redirect('/steps/edit')->with('flash_message', __('不正な操作が行われました。'));
    }

    $categories = Category::get();
    $step_info = ParentStep::find($id);
    // parent_stepsとchild_stepに登録されているデータをparents_stepsテーブルのidをもとにひっぱってくる
    // $step_info = Auth::user()->parent_steps()->find($id)->with('child_steps')->get();

    return view('steps.edit', compact('step_info','categories'));
    }
}