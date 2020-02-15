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
// 認証関係のルーティング
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
