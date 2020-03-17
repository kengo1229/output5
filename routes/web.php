<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// TOP（初期画面）表示のルーティング
Route::get('/', 'TopController@index')->name('top');

/*
存在しないURLを入力した場合、特定のファイルを返す。
「Route::fallback」を用いなくても存在しないURLを入力した場合、「errors.404」ファイルを表示させることは可能だが
認証機能が働かないため、ナビメニューをログインの有無で動的に変化させることができなかった。
*/
Route::fallback(function () {
    return view('errors.404');
});

// 認証関係のルーティング
Auth::routes();

// ログインしていないと機能しないルーティング
Route::group(['middleware' => 'auth'], function() {
  // step登録画面表示のルーティング
  Route::get('/steps/new', 'StepsController@new')->name('steps.new');
  // step登録機能のルーティング
  Route::post('/steps/create', 'StepsController@create')->name('steps.create');
  // step編集画面表示のルーティング
  Route::get('/steps/{id}/edit', 'StepsController@edit')->name('steps.edit');
  // step編集機能のルーティング
  Route::post('/steps/{id}', 'StepsController@update')->name('steps.update');
  // チャレンジが終了したSTEPの詳細表示ルーティング
  Route::get('/steps/{id}/record', 'StepsController@record')->name('steps.record');
  // プロフィール登録画面表示のルーティング
  Route::get('/profile/{id}/new', 'ProfileController@new')->name('profile.new');
  // プロフィール登録機能のルーティング
  Route::post('/profile/{id}/create', 'ProfileController@create')->name('profile.create');
  // プロフィール編集画面表示のルーティング
  Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile.edit');
  // プロフィール編集機能のルーティング
  Route::post('/profile/{id}', 'ProfileController@update')->name('profile.update');
  // STEPチャレンジ登録機能のルーティング
  Route::get('/challenge/{id}/create', 'ChallengeController@create')->name('challenge.create');
  // STEPチャレンジ画面表示のルーティング
  Route::get('/challenge/{id}/show', 'ChallengeController@show')->name('challenge.show');
  // STEPチャレンジ中断のルーティング
  Route::get('/challenge/stop', 'ChallengeController@stop')->name('challenge.stop');
  // STEPクリア機能のルーティング
  Route::post('/challenge/{id}/clear', 'ChallengeController@clear')->name('challenge.clear');
  // マイページ画面表示のルーティング
  Route::get('/mypage/{id}', 'MypageController@index')->name('mypage.index');

});

// STEP一覧表示機能のルーティング
Route::get('/steps', 'StepsController@index')->name('steps');
// ajaxでjsonにアクセスするためのルーティング
Route::get('/ajax/steps', 'Ajax\ParentStepController@index')->name('ajax.show');
// 親STEP詳細表示機能のルーティング
Route::get('/steps/{id}', 'StepsController@show')->name('steps.show');
// 子STEP詳細表示機能のルーティング
Route::get('/detail/{id}', 'StepsController@detail')->name('steps.detail');
// プロフィール画面表示のルーティング
Route::get('/profile/{id}/show', 'ProfileController@show')->name('profile.show');
// STEP投稿説明画面表示のルーティング
Route::get('/explanation/post', 'ExplanationController@postIndex')->name('explanation.post');
// STEPチャレンジ説明画面表示のルーティング
Route::get('/explanation/challenge', 'ExplanationController@challengeIndex')->name('explanation.challenge');
