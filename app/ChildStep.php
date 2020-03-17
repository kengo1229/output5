<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildStep extends Model
{
    protected $table = 'child_steps';
    protected $fillable = ['parent_step_id', 'step', 'todo'];

}