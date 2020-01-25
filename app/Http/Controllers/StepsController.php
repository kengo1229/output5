<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepsController extends Controller
{
  // stepを登録する為のアクションメソッド
  public function new()
  {
      return view('steps.new');
  }
}
