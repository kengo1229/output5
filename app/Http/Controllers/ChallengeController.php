<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\ChallengeChildStep;
use App\FinishParentStep;
use App\FinishChildStep;
use App\Http\Requests\ChallengeRequest;

class ChallengeController extends Controller
{
  // チャレンジするSTEPの情報をchallenge_parent_stepとchallenge_child_stepに登録する
  public function create($id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
      return redirect('/')->with('flash_message', __('不正な操作が行われました。'));
    }

    $parent_step = ParentStep::with('category')->find($id);

    /*
    ログイン済みユーザーとstepを登録したユーザーが同じ場合、
    編集画面に飛ばす(自分で登録したSTEPにはチャレンジできない）
    */
    if(($parent_step->user_id) === Auth::id()){
      return redirect()->route('steps.edit', ['id' => $parent_step->id]);
    }

    // 既にチャレンジ中のSTEPにチャレンジした場合、新しくチャレンジ画面が作成されるのではなくチャレンジ中の画面に飛ばされる
    $new_challenge_flg = ChallengeParentStep::where('user_id', Auth::id())->where('parent_step_id', $id)
    ->where('end_flg', 0)->first();

    if(isset($new_challenge_flg)){
      return redirect()->route('challenge.show', ['id' => $new_challenge_flg->id])
      ->with('flash_message', 'このSTEPは既にチャレンジ中です。');;
    }

    // challenge_parent_stepsテーブルにチャレンジするユーザーと親STEPの情報を登録する
    ChallengeParentStep::create(['user_id' => Auth::id(), 'parent_step_id' => $parent_step->id]);
    // challenge_parent_stepsテーブルから最新のidを変数に格納
    $challenge_parent_step_id = ChallengeParentStep::latest('id')->first()->id;

    // 親STEPに紐づいた子STEPのidを$idでまとめて取得する
    $child_steps =  ChildStep::where('parent_step_id', $id)->get();

    /*
    challenge_child_step_arrayにチャレンジ中の子STEP情報を登録する
    */
    $challenge_child_step_array = [];

    $challenge_child_step_array[0] = array('challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_steps[0]['id'],
     'num_child_step' =>'1', 'created_at' => now(), 'updated_at' => now());

     /*
     子STEP２以降は任意入力のため、空かどうかを判定した上で配列に追加していく。
     */
     for($i = 1; $i <= 4; $i++) {
       if(isset($child_steps[$i]['step'])){
         $challenge_child_step_array[$i] = array('challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_steps[$i]['id'],
          'num_child_step' =>($i + 1), 'created_at' => now(), 'updated_at' => now());
       }
     }

    // チャレンジする親STEPに、紐づく子STEPの総数を挿入する
    $challenge_parent_step = ChallengeParentStep::find($challenge_parent_step_id);
    $challenge_parent_step->total_child_step = count($challenge_child_step_array);
    $challenge_parent_step->save();

    // 配列を一気にDBに挿入する
    ChallengeChildStep::insert($challenge_child_step_array);

  // 登録が完了したら、challenge_parent_stepのidを渡してチャレンジ画面に飛ばす
  return redirect()->route('challenge.show', ['id' => $challenge_parent_step_id])
  ->with('flash_message', 'チャレンジスタート！');;

  }

  // チャレンジ画面の表示
    public function show($id)
    {

      // GETパラメータが数字かどうかをチェックする
      if(!ctype_digit($id)){
        return redirect('/')->with('flash_message', __('不正な操作が行われました。'));
      }


      // ログインしているユーザーが親STEPの挑戦者と一致する場合、画面表示処理に入る(他人のSTEP進捗をいじれないようにする)
      $user = auth()->user();

      $challenge_parent_step = ChallengeParentStep::find($id);

      if($user->id === $challenge_parent_step['user_id']){
        // チャレンジ中の親STEPのparent_step_idを取得
        $parent_step_id = $challenge_parent_step['parent_step_id'];
        // 取得したparent_step_idを元に親STEPの情報をカテゴリーとユーザー情報含めて取得
        $parent_step_info = ParentStep::with(['category', 'user'])
        ->where('id', $parent_step_id)->first();

        /*
        $idを元にしてチャレンジ中の親STEPに紐づく子STEPのend_flgが
        全て1(全クリア)なら親STEPのend_flgも1にする
        */
        $challenge_child_step = new ChallengeChildStep;
        if($challenge_child_step::where('challenge_parent_step_id', $id)->where('end_flg', '0')->first() === null){

          $challenge_parent_step = ChallengeParentStep::where('id', $id)->first();
          $challenge_parent_step->end_flg = '1';
          $challenge_parent_step->save();

        /*
        クリアした親STEPの情報をfinish_parent_stepsテーブルに保存する
        クリアした親STEPの情報を別テーブルに保存するのはクリア後の編集によって影響を受けないようにするため。
        */
        $finish_parent_step = new FinishParentStep;
        $finish_parent_step->title = $parent_step_info->title;
        $finish_parent_step->goal_time = $parent_step_info->goal_time;
        $finish_parent_step->total_time = $challenge_parent_step->total_time;
        $finish_parent_step->category_id = $parent_step_info->category_id;
        $finish_parent_step->description = $parent_step_info->description;
        $finish_parent_step->pic = $parent_step_info->pic;
        $finish_parent_step->create_step_user_id = $parent_step_info->user_id;
        $finish_parent_step->challenge_user_id = Auth::id();
        $finish_parent_step->save();

        /*
        最新のfinish_parent_stepsのidを変数に格納
        */
        $finish_parent_step_id = $finish_parent_step::latest('id')->first()->id;
        $finish_child_step = $challenge_child_step::where('challenge_parent_step_id', $id)->where('end_flg', '1')->with('childStep')->get();

        /*
        クリアした子STEPの情報をfinish_child_stepsテーブルに保存する
        クリアした子STEPの情報を別テーブルに保存するのはクリア後の編集によって影響を受けないようにするため。
        */
        $finish_child_step_array = [];
        $finish_child_step_array[0] = array('step' => $finish_child_step[0]->childStep->step, 'todo' =>  $finish_child_step[0]->childStep->todo,
        'finish_parent_step_id' => $finish_parent_step_id, 'created_at' => now(), 'updated_at' => now());

        for($i = 1; $i <= 4; $i++) {
            if(isset($finish_child_step[$i]['id'])){
            $finish_child_step_array[$i] = array('step' => $finish_child_step[$i]->childStep->step, 'todo' =>  $finish_child_step[$i]->childStep->todo,
             'finish_parent_step_id' => $finish_parent_step_id, 'created_at' => now(), 'updated_at' => now());
        }
      }

        FinishChildStep::insert($finish_child_step_array);


          // 全てクリアしたら最後にマイページへ飛ばす
          return redirect()->route('mypage.index', ['id' => Auth::id()])->with('flash_message', 'おめでとうございます！全STEPクリアです！');
        }

        //チャレンジの親STEP情報に紐づくまだクリアしていない子STEP情報を取得(クリアの判定は'end_flgでつける)
        $challenge_child_step_info = ChallengeChildStep::with('childStep')->where('challenge_parent_step_id', $id)
        ->where('end_flg', '0')->first();

      //チャレンジ画面に飛ばす
      return view('challenge.show', compact('parent_step_info', 'challenge_child_step_info'));

      }else{
        return redirect('/steps')->with('flash_message', __('このSTEPにチャレンジしていません。'));
      }

    }

  // クリアボタン押して次の子STEPに進む機能
  public function clear(ChallengeRequest $request,$id)
  {
    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
      return redirect('/')->with('flash_message', __('不正な操作が行われました。'));
    }

    // challenge_child_stepから$idを元に該当のレコードを検索する
    $challenge_child_step = ChallengeChildStep::where('id', $id)->first();
    // end_flgを1（クリア）に更新する
    $challenge_child_step->end_flg = '1';
    //かかった時間を登録する
    $challenge_child_step->passed_time = $request->passed_time;
    $challenge_child_step->save();



    // $idを元にチャレンジ中の親STEPのidを取得する
    $challenge_parent_step_id = ChallengeChildStep::where('id', $id)->value('challenge_parent_step_id');
    // 取得した親STEPのidを元に子STEPに紐づく親STEPにクリアした子STEPの番数を入れる
    $challenge_parent_step = ChallengeParentStep::find($challenge_parent_step_id);
    $challenge_parent_step->num_clear_child_step = $challenge_child_step->num_child_step;
    // challenge_parent_stepsテーブルのtotal_timeに子ステップクリアにかかった時間を加えていく
    $challenge_parent_step->total_time = ($challenge_parent_step->total_time) + ($challenge_child_step->passed_time);

    $challenge_parent_step->save();


    return redirect()->route('challenge.show', ['id' => $challenge_parent_step_id]);
  }

// チャレンジの中断（フラッシュメッセージ付きでマイページに飛ばす）
  public function stop() {
    return redirect()->route('mypage.index', ['id' => Auth::id() ])->with('flash_message', __('チャレンジを中断しました。再チャレンジをお待ちしています！！'));
  }

}
