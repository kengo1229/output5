<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\ParentStep;
use App\ChildStep;
use App\ChallengeParentStep;
use App\ChallengeChildStep;
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
    $child_step_id =  ChildStep::where('parent_step_id', $id)->get('id');
    // challenge_child_stepsにチャレンジ中の子STEP情報を登録する
    ChallengeChildStep::insert([
      ['challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[0]['id'],
       'num_child_step' =>'1', 'created_at' => now(), 'updated_at' => now() ],
      ['challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[1]['id'],
       'num_child_step' =>'2', 'created_at' => now(), 'updated_at' => now() ],
      ['challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[2]['id'],
       'num_child_step' =>'3', 'created_at' => now(), 'updated_at' => now()  ],
      ['challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[3]['id'],
       'num_child_step' =>'4', 'created_at' => now(), 'updated_at' => now()  ],
      ['challenge_parent_step_id' => $challenge_parent_step_id,  'child_step_id' => $child_step_id[4]['id'],
       'num_child_step' =>'5', 'created_at' => now(), 'updated_at' => now()  ]
    ]);

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

      if($user->id === ChallengeParentStep::where('id', $id)->select('user_id')->first()['user_id']){
        // チャレンジ中の親STEPのparent_step_idを取得
        $parent_step_id = ChallengeParentStep::where('id', $id)->select('parent_step_id')->first();

        // 取得したparent_step_idを元に親STEPの情報をカテゴリーとユーザー情報含めて取得
        $parent_step_info = ParentStep::with(['category', 'user'])
        ->where('id', $parent_step_id['parent_step_id'])->first();

        /*
        $idを元にしてチャレンジ中の親STEPに紐づく子STEPのend_flgが
        全て1(全クリア)なら親STEPのend_flgも1にする
        */
        if(ChallengeChildStep::where('challenge_parent_step_id', $id)->where('end_flg', '0')->first() === null){
          $challenge_parent_step = ChallengeParentStep::where('id', $id)->first();
          $challenge_parent_step->end_flg = '1';
          $challenge_parent_step->save();

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


}
