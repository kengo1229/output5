<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\FinishParentStep;
use App\FinishChildStep;
use App\User;
use App\Http\Requests\StepRequest;

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

    /*
    child_stepsテーブルにフォームに入力された情報とparent_step_idを登録する
    入力フォームの子STEPとやることは子STEP2以降が任意入力になっているので、両方の入力が確認できたら
    配列形式で大本の配列である$child_step_arrayに追加して、最後にinsertで一気にDBに挿入する
    */
    //

    $child_step_array = [];

    $child_step_array[0] = array('parent_step_id' => $parent_step->id,  'step' => $request->step0, 'todo' =>  $request->todo0,
     'created_at' => now(), 'updated_at' => now());

     for($i = 1; $i <= 4; $i++) {
       if($request->input('step'.$i) != null && $request->input('todo'.$i) != null){
         $child_step_array[$i] = array('parent_step_id' => $parent_step->id,  'step' => $request->input('step'.$i), 'todo' =>  $request->input('todo'.$i),
          'created_at' => now(), 'updated_at' => now());
       }
     }

    ChildStep::insert($child_step_array);

    return redirect('/steps')->with('flash_message', '登録が完了しました!');
  }

  // step編集画面表示機能
  public function edit($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    /*
    編集しようとしているSTEPがチャレンジ中の場合、編集できないようにしたいので判定用の変数を用意して
    変数の中身を変える
    */
    $exist = ChallengeParentStep::select('end_flg')->where('parent_step_id', $id)->exists();

    if($exist) {
      $end_flg = ChallengeParentStep::select('end_flg')->where('parent_step_id', $id)->first();

      if ($end_flg['end_flg'] === 0) {
        $challenge_flg = true;
      }elseif($end_flg['end_flg'] === 1) {
        $challenge_flg = '';
      }
    }else{
      $challenge_flg = '';
    }

    $user = Auth::user();
    $categories = Category::get();
    // $idを元にparent_stepテーブルに登録されたデータを格納
    $parent_step_info = $user->parent_steps()->with('category')->find($id);

    // $idを元にchild_stepテーブルに登録されたデータを格納
    $child_step_info  = ChildStep::where('parent_step_id', $id)->get();

    return view('steps.edit', compact('user', 'parent_step_info', 'child_step_info', 'categories', 'challenge_flg'));

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

      /*
      child_stepsテーブルの更新
      子STEP2以降は任意入力のため、$idに対応する子STEPで既に挿入されているものについては更新をして
      新たに追加される子STEPについては配列形式で一気に挿入する
      */
      $child_steps = ChildStep::where('parent_step_id', $id)->get();
      $child_step_array = [];

      for ($i = 0; $i <= 4; $i++){
        if(isset($child_steps[$i])){
          ChildStep::updateOrInsert(
            ['id' => $child_steps[$i]->id],
            ['parent_step_id' => $id, 'step' => $request->input('step'.$i), 'todo' => $request->input('todo'.$i)]
        );
      }else{
        if($request->input('step'.$i) != null && $request->input('todo'.$i) != null){
          $child_step_array[$i] = array('parent_step_id' => $parent_step->id,  'step' => $request->input('step'.$i), 'todo' =>  $request->input('todo'.$i),
           'created_at' => now(), 'updated_at' => now());
        }
      }
   }

      ChildStep::insert($child_step_array);

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
      $child_steps  = ChildStep::where('parent_step_id', $id)->get();

      return view('steps.show', compact('parent_step', 'child_steps', 'user'));
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
      $child_steps  = ChildStep::where('parent_step_id', $id)->get();

      return view('steps.detail', compact( 'parent_step', 'child_steps'));
    }

    // チャレンジが終了したSTEPの詳細表示機能
    public function record($id)
    {

      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }

      /*
      STEPにチャレンジしていたユーザーとログインユーザーが一致する場合のみ、表示する
      */
      $finish_parent_step = FinishParentStep::with(['user', 'category'])->find($id);

      if(($finish_parent_step['challenge_user_id']) !== Auth::id()){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
      }

      // 親STEPに紐づいた子STEPのデータを格納
      $finish_child_step  = FinishChildStep::where('finish_parent_step_id', $id)->get();

      return view('steps.record', compact( 'finish_parent_step', 'finish_child_step'));
    }

}
