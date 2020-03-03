<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\ParentStep;

class ParentStepController extends Controller
{
  public function index() {

    return ParentStep::with('category')->latest()->get();

    }

}
