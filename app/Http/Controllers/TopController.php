<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ParentStep;

class TopController extends Controller
{
  public function index() {

    // 登録されたSTEPを最新のものから取得する
    $latest_parent_steps = ParentStep::with('category')->latest()->take(8)->get();

    return view('top.top',compact('latest_parent_steps'));
  }
}
