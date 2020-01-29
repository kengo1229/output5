<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StepRequest;
use App\User;

class ProfileController extends Controller
{
  // プロフィール新規登録画面の表示機能
  public function new()
  {
    return view('profiele.new');
  }
}
