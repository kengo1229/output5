<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ParentStep;

class TopController extends Controller
{
  public function index() {

    // 登録されたSTEPを最新のものから20件取得する
    $latest_parent_steps = ParentStep::with('category')->latest()->get();

    \Log::info('ログ出力テスト'.$latest_parent_steps);
    return view('top.top','latest_parent_steps');
  }
}
