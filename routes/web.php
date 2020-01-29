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

Route::get('/', function () {
    return view('welcome');
});
// 認証関係のルーティング
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログインしていないと機能しないルーティング
Route::group(['middleware' => 'auth'], function() {
  // step新規登録画面表示のルーティング
  Route::get('/steps/new', 'StepsController@new')->name('steps.new');
  // step新規登録機能のルーティング
  Route::post('/steps/create', 'StepsController@create')->name('steps.create');
  // step編集画面表示のルーティング
  Route::get('/steps/{id}/edit', 'StepsController@edit')->name('steps.edit');
  // step編集機能のルーティング
  Route::post('/steps/{id}', 'StepsController@update')->name('steps.update');
  // プロフィル新規登録画面表示のルーティング
  Route::get('/profiele/new', 'ProfieleController@new')->name('profiele.new');
  // step新規登録機能のルーティング
  Route::post('/profiele/create', 'ProfieleController@create')->name('profiele.create');

});

// STEP一覧機能のルーティング
Route::get('/steps', 'StepsController@index')->name('steps');

// STEP詳細機能のルーティング
Route::get('/steps/{id}', 'StepsController@show')->name('steps.show');
