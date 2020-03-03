<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChallengeParentStep extends Model
{
  protected $table = 'challenge_parent_steps';
  protected $fillable = ['user_id', 'parent_step_id', 'end_flg'];


  // parent_stepsテーブルとのリレーション
  public function parentStep()
      {
          return $this->belongsTo('App\ParentStep');
      }

  public function challengeChildSteps()
    {
        return $this->hasMany('App\ChallengeChildStep');
    }

}