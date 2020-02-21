<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    // 画像を登録した場合、AWSのs3に作ったフォルダに保存する
    // herokuのDBにはフォルダへのリンクを保存する
    if(!empty($request->pic)){

    $uploadImg = $parent_step->pic = $request->file('pic');
      $path = Storage::disk('s3')->putFile('/step_img', $uploadImg, 'public');
      $parent_step->pic = Storage::disk('s3')->url($path);

    }

    // フォームに入力された値をparent_stepsテーブルに登録する
    $parent_step->fill($request->all())->save();

    // parent_stepsテーブルから最新のidを変数に格納
    $parent_step_id = ParentStep::latest('id')->first()->id;

    // child_stepsテーブルにフォームに入力された情報とparent_step_idを登録する
    // 各stepとtodoに入力された値を配列形式で一気に登録する
    ChildStep::insert([
    ['parent_step_id' => $parent_step->id,  'step' => $request->step0, 'todo' =>  $request->todo0,
     'created_at' => now(), 'updated_at' => now() ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step1, 'todo' =>  $request->todo1,
     'created_at' => now(), 'updated_at' => now() ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step2, 'todo' =>  $request->todo2,
    'created_at' => now(), 'updated_at' => now()  ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step3, 'todo' =>  $request->todo3,
     'created_at' => now(), 'updated_at' => now()  ],
    ['parent_step_id' => $parent_step->id,  'step' => $request->step4, 'todo' =>  $request->todo4,
     'created_at' => now(), 'updated_at' => now()  ]
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

      // 画像を登録した場合、AWSのs3に作ったフォルダに保存する
      // herokuのDBにはフォルダへのリンクを保存する
      if(!empty($request->pic)){

        $uploadImg = $parent_step->pic = $request->file('pic');
          $path = Storage::disk('s3')->putFile('/step_img', $uploadImg, 'public');
          $parent_step->pic = Storage::disk('s3')->url($path);

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
