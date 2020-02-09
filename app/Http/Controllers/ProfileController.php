<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use App\ParentStep;

class ProfileController extends Controller
{
  // プロフィール登録画面の表示機能
  public function new($id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/top')->with('flash_message', __('不正な操作が行われました。'));
    }

    // プロフィールが既に登録済みの場合、編集画面に飛ばす(ユーザー名があったら、既に登録済みと判断)
    $user = Auth::user();
    if(!empty($user->username)){
      return redirect('profile/' . $id . '/edit');
    }

    return view('profile.new', compact('user'));
  }

  // プロフィール登録機能
  public function create(ProfileRequest $request, $id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/top')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user =  Auth::user();

    //アップロードされた画像をstoreAsメソッドで保存場所とファイル名を指定して保存
    // 画像を登録しない場合、storeAsにエラーが出るため条件をつける
    if(!empty($request->pic)){
      $time = date("Ymdhis");
      $user->pic = $request->pic->storeAs('public/profile_images', $time.'_'.Auth::user()->id . '.jpg');
    }

    // フォームに入力された値をusersテーブルに登録する
    $user->fill($request->all())->save();


    // プロフィールの登録が完了したらマイページに飛ばす
    return redirect()->route('mypage.index', ['id' => Auth::id()])->with('flash_message', 'プロフィールの登録が完了しました!');
  }

  // プロフィール編集画面の表示機能
  public function edit($id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/top')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user = Auth::user();

    // 入力必須のユーザー名がない＝プロフィール未登録の場合、登録画面に飛ばす
    if(empty($user->username)){
      return redirect('profile/' . $id . '/new');
    }

    // 登録された画像を表示するためにパスを変更する
    $user->pic = str_replace( 'public' , 'storage' , $user->pic);

    return view('profile.edit', compact('user'));
  }

  // プロフィール編集機能
  public function update(ProfileRequest $request, $id)
  {

    if($id != Auth::id()){
        return redirect('/top')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user =  Auth::user();

    // 画像を変更しない場合、storeAsにエラーが出るため条件をつける
    if(!empty($request->pic)){
      $time = date("Ymdhis");
      $user->pic = $request->pic->storeAs('public/profile_images', $time.'_'.Auth::user()->id . '.jpg');
    }

    // フォームに入力された値をusersテーブルに登録する
    $user->fill($request->all())->save();


    // プロフィールの登録が完了したらマイページに飛ばす
    return redirect()->route('mypage.index', ['id' => Auth::id()])->with('flash_message', 'プロフィールの編集が完了しました!');
  }

  // プロフィール表示機能
  public function show($id)
  {

    // GETパラメータが数字かどうかをチェックする
    if(!ctype_digit($id)){
      return redirect('/top')->with('flash_message', __('不正な操作が行われました。'));
    }
    // パラメーターから渡ってきた$idを元にしてユーザー情報の取得
    // 中に入っているのは親STEP詳細画面から渡ってきたSTEP投稿者のユーザーid
    $user =  User::find($id);

    // 自分が登録したSTEPを最新のものから順に取得する
    $my_create_steps = ParentStep::with('category')->where('user_id', $id)->latest()->get();

    // プロフィールの登録が完了したらマイページに飛ばす
    return view('profile.show', compact('user','my_create_steps'));
  }

}
