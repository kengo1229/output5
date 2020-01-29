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

    return view('steps.new', compact('categories'));
  }

// STEP新規登録機能
  public function create(StepRequest $request)
  {

    $parent_step = new ParentStep;
    // ログインしているユーザーのidを格納する
    $parent_step->user_id = Auth::user()->id;
    //アップロードされた画像をstoreAsメソッドで保存場所とファイル名を指定して保存
    $time = date("Ymdhis");
    $parent_step->pic = $request->pic->storeAs('public/step_images', $time.'_'.Auth::user()->id . '.jpg');
    // フォームに入力された値をparent_stepsに登録する
    $parent_step->fill($request->all())->save();

    // 最新のparent_stepsテーブルのidを変数に格納
    $parent_step_id = ParentStep::latest('id')->first()->id;

    // child_stepsテーブルのparent_step_idカラムに$parent_step_idを格納
    $child_step = new ChildStep;
    $child_step->parent_step_id = $parent_step_id;
    // フォームに入力された値をchild_stepsに登録する
    $child_step->fill($request->all())->save();

    // stepの登録が完了したらホーム画面に飛ばす
    return redirect('/home')->with('flash_message', '登録が完了しました!');
  }

  // step編集画面表示機能
  public function edit($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
        return redirect('/steps/new')->with('flash_message', __('不正な操作が行われました。'));
    }
    $categories = Category::get();
    // $idを元にparent_stepテーブルに登録されたデータを格納
    $parent_step_info = Auth::user()->parent_steps()->find($id);

    // $idを元にchild_stepテーブルに登録されたデータを格納
    $child_step_info  = ChildStep::where('parent_step_id', $id)->first();

    return view('steps.edit', compact('parent_step_info', 'child_step_info', 'categories'));

    }

    //STEP編集機能
    public function update(StepRequest $request, $id)
    {
      if(!ctype_digit($id)){
        return redirect('/steps/new')->with('flash_message', __('不正な操作が行われました。'));
      }

      // parent_stepsテーブルの更新
      $parent_step = Auth::user()->parent_steps()->find($id);
      $time = date("Ymdhis");
      $parent_step->pic = $request->pic->storeAs('public/step_images', $time.'_'.Auth::user()->id . '.jpg');

      $parent_step->fill($request->all())->save();

      // child_stepsテーブルの更新
      $child_step = ChildStep::where('parent_step_id', $id)->first();
      $child_step->fill($request->all())->save();



      return redirect('/steps/new')->with('flash_message', __('編集が完了しました!'));
    }

    // STEP一覧表示機能
    public function index() {
      // リレーションを貼ったcategoryテーブルとparent_stepsのデータを1ページ20件ごとに格納
      $index_step_info = ParentStep::with('category')->paginate(20);

      return view('steps.index',compact('index_step_info'));
    }

    // STEP詳細表示機能
    public function show($id)
    {
      if(!ctype_digit($id)){
        return redirect('/steps/index')->with('flash_message', __('不正な操作が行われました。'));
      }

      $parent_step = ParentStep::with('category')->find($id);

      // ログイン済みユーザーとstepを登録したユーザーが同じ場合、編集画面に飛ばす
      if(($parent_step->user_id) === Auth::id()){
        return redirect()->route('steps.edit', ['id' => $parent_step->id]);
      }

      $child_step  = ChildStep::where('parent_step_id', $id)->first();

      return view('steps.show', compact('parent_step', 'child_step'));
    }


}
