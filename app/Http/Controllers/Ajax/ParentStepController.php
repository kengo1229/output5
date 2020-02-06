<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ParentStep;

class ParentStepController extends Controller
{
  public function index() {

    // parent_stepsテーブルの情報を20件ずつ取得してjson形式でreturnする
    return ParentStep::with('category')->paginate(20)->all();

    }

}
