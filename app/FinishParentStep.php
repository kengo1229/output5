<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishParentStep extends Model
{
  protected $table = 'finish_parent_steps';

  // parent_stepsテーブルとのリレーション
  public function parentStep()
      {
          return $this->belongsTo('App\ParentStep');
      }

  //categoriesテーブルとのリレーション
  public function category()
      {
          return $this->belongsTo('App\Category');
      }

  //usersテーブルとのリレーション
  public function user()
      {
          return $this->belongsTo('App\User', 'create_step_user_id', 'id');
      }

}
