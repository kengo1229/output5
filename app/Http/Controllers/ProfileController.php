<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
  // プロフィール登録画面の表示機能
  public function new($id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user = Auth::user();

    return view('profile.new', compact('user'));
  }

  // プロフィール登録機能
  public function create(ProfileRequest $request, $id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
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
    return redirect('/home')->with('flash_message', 'プロフィールの登録が完了しました!');
  }

  // プロフィール編集画面の表示機能
  public function edit($id)
  {
    // GETパラメータがログインユーザーのidと同一かチェックする
    if($id != Auth::id()){
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
    }

    $user = Auth::user();

    // ユーザー名がない＝プロフィール未登録の場合、登録画面に飛ばす
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
        return redirect('/steps')->with('flash_message', __('不正な操作が行われました。'));
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
    return redirect('/home')->with('flash_message', 'プロフィールの登録が完了しました!');
  }

}
