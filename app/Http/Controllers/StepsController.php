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

    $parent_step->user_id = Auth::user()->id;
    //アップロードされた画像をstoreAsメソッドで保存場所とファイル名を指定して保存
    // 画像を登録しない場合、storeAsにエラーが出るため条件分岐させる
    if(!empty($request->pic)){
    $time = date("Ymdhis");
    $parent_step->pic = $request->pic->storeAs('public/step_images', $time.'_'.Auth::user()->id . '.jpg');
    }

    // フォームに入力された値をparent_stepsテーブルに登録する
    $parent_step->fill($request->all())->save();

    // 最新のparent_stepsテーブルのidを変数に格納
    $parent_step_id = ParentStep::latest('id')->first()->id;

    // child_stepsテーブルのparent_step_idカラムに$parent_step_idを格納



    $child_step = new ChildStep;

    $i = 0;
        foreach($request->num as $val){
        $child_step->parent_step_id = $parent_step_id;
        $child_step->step = $request->step[$i];
        $child_step->todo = $request->todo[$i];
        $child_step->save();
        $i++;
        }






    // $child_step = new ChildStep;
    // $child_step->parent_step_id = $parent_step_id;
    // // フォームに入力された値をchild_stepsに登録する
    // $child_step->fill($request->all())->save();

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
    // 登録された画像を表示するためにパスを変更する
    $parent_step_info->pic = str_replace( 'public' , 'storage' , $parent_step_info->pic);
    // $idを元にchild_stepテーブルに登録されたデータを格納
    $child_step_info  = ChildStep::where('parent_step_id', $id)->first();

    return view('steps.edit', compact('parent_step_info', 'child_step_info', 'categories'));

    }

    //STEP編集機能
    public function update(StepRequest $request, $id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps/new')->with('flash_message', __('不正な操作が行われました。'));
      }

      // parent_stepsテーブルの更新
      $parent_step = Auth::user()->parent_steps()->find($id);

      // 画像を変更しない場合、storeAsにエラーが出るため条件分岐させる
      if(!empty($request->pic)){
        $time = date("Ymdhis");
        $parent_step->pic = $request->pic->storeAs('public/step_images', $time.'_'.Auth::user()->id . '.jpg');
      }

      $parent_step->fill($request->all())->save();

      // child_stepsテーブルの更新
      $child_step = ChildStep::where('parent_step_id', $id)->first();
      $child_step->fill($request->all())->save();

      return redirect('/steps/new')->with('flash_message', __('編集が完了しました!'));
    }

    // STEP一覧表示機能
    public function index() {
      // リレーションを貼ったcategoryテーブルとparent_stepsのデータを1ページ20件ごとに格納
      $index_steps = ParentStep::with('category')->paginate(20);

      return view('steps.index',compact('index_steps'));
    }

    // 親STEP詳細表示機能
    public function show($id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }

      $parent_step = ParentStep::with('category')->find($id);
      // STEP登録者のユーザー情報を格納
      $user = User::find($parent_step->user_id);

      // 親STEPに紐づいた子STEPのデータを格納
      $child_step  = ChildStep::where('parent_step_id', $id)->first();

      return view('steps.show', compact('parent_step', 'child_step', 'user'));
    }

    // 子STEP詳細表示機能
    public function detail($id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }
      // 親STEPに紐づいた子STEPのデータを格納
      $child_step  = ChildStep::where('parent_step_id', $id)->first();

      return view('steps.detail', compact( 'child_step'));
    }

}
