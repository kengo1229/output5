<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishParentStep extends Model
{
  protected $table = 'finish_parent_steps';

  //categoriesテーブルとのリレーション
  public function category()
      {
          return $this->belongsTo('App\Category');
      }

}
