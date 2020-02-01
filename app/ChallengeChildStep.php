<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeChildStep extends Model
{
  protected $table = 'challenge_child_steps';
  protected $fillable = ['challenge_parent_id', 'child_step_id', 'end_flg'];
}
