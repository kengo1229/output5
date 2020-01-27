<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentStep extends Model
{
    protected $table = 'parent_steps';
    protected $fillable = ['title', 'category_id', 'goal_time', 'description', 'pic','user_id'];

    //child_stepテーブルとのリレーション
    public function child_step()
        {
            return $this->hasOne('App\ChildStep');
        }
}
