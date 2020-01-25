<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class StepsController extends Controller
{
  // stepを登録する為のアクションメソッド
  public function new()
  {
    // categoryテーブルの全ての値を取得
      $categories = Category::get();
      return view('steps.new', ['categories' => $categories]);
  }
}
