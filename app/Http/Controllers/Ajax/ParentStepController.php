<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ParentStep;

class ParentStepController extends Controller
{
  public function index() {

    return ParentStep::with('category')->latest()->get();

    }

}
