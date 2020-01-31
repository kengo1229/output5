<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildStep extends Model
{
    protected $table = 'child_steps';
    protected $fillable = ['parent_step_id', 'step0', 'todo0','step1', 'todo1','step2', 'todo2','step3', 'todo3','step4', 'todo4'];

}
