<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    // parent_stepsテーブルから最新のidを変数に格納
    $parent_step_id = ParentStep::latest('id')->first()->id;

    // child_stepsテーブルにフォームに入力された情報とparent_step_idを登録する
    // 各stepとtodoに入力された値を配列形式で一気に登録する
    ChildStep::insert([
    ['parent_step_id' => $parent_step->id,  'step' => $request->step0, 'todo' =>  $request->todo0 ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step1, 'todo' =>  $request->todo1 ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step2, 'todo' =>  $request->todo2 ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step3, 'todo' =>  $request->todo3 ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step4, 'todo' =>  $request->todo4 ]
]);

    return redirect('/steps')->with('flash_message', '登録が完了しました!');
  }

  // step編集画面表示機能
  public function edit($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user = Auth::user();
    $categories = Category::get();
    // $idを元にparent_stepテーブルに登録されたデータを格納
    $parent_step_info = $user->parent_steps()->find($id);
    // 登録された画像を表示するためにパスを変更する
    $parent_step_info->pic = str_replace( 'public' , 'storage' , $parent_step_info->pic);
    // $idを元にchild_stepテーブルに登録されたデータを格納
    $child_step_info  = ChildStep::where('parent_step_id', $id)->get();


    return view('steps.edit', compact('user', 'parent_step_info', 'child_step_info', 'categories'));

    }

    //STEP編集機能
    public function update(StepRequest $request, $id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
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
      // 入力フォームにstep・todoが5つずつ入力箇所があるのでfor文使用して更新処理を5回行う
      for ($i = 0; $i <= 4; $i++){
       $child_step = ChildStep::where('parent_step_id', $id)->get();
       $child_step = ChildStep::find($child_step[$i]->id);
       $child_step->step = $request->input('step'.$i);
       $child_step->todo = $request->input('todo'.$i);
       $child_step->save();
   }

      return redirect('/steps')->with('flash_message', __('編集が完了しました!'));
    }

    // STEP一覧表示機能
    public function index() {
      // リレーションを貼ったcategoryテーブルとparent_stepsのデータを1ページ20件ごとに格納

      return view('steps.index');
    }

    // 親STEP詳細表示機能
    public function show($id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }

      $parent_step = ParentStep::with('category')->find($id);

      // ログイン済みユーザーとstepを登録したユーザーが同じ場合、編集画面に飛ばす
      if(($parent_step->user_id) === Auth::id()){
        return redirect()->route('steps.edit', ['id' => $parent_step->id]);
      }

      // STEP登録者のユーザー情報を格納
      $user = User::find($parent_step->user_id);

      // 親STEPに紐づいた子STEPのデータを格納
      $child_step  = ChildStep::where('parent_step_id', $id)->get();

      return view('steps.show', compact('parent_step', 'child_step', 'user'));
    }

    // 子STEP詳細表示機能
    public function detail($id)
    {
      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }

      $parent_step = ParentStep::find($id);

      // ログイン済みユーザーとstepを登録したユーザーが同じ場合、編集画面に飛ばす
      if(($parent_step->user_id) === Auth::id()){
        return redirect()->route('steps.edit', ['id' => $parent_step->id]);
      }

      // 親STEPに紐づいた子STEPのデータを格納
      $child_step  = ChildStep::where('parent_step_id', $id)->get();

      return view('steps.detail', compact( 'child_step'));
    }

}
