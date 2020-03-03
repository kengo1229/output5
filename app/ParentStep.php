<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentStep extends Model
{
    protected $table = 'parent_steps';
    // 画像のパスを変更して保存するためpicは含めない
    protected $fillable = ['title', 'category_id', 'goal_time', 'description'];

    //child_stepテーブルとのリレーション
    public function child_step()
        {
            return $this->hasOne('App\ChildStep');
        }

    //categoriesテーブルとのリレーション
    public function category()
        {
            return $this->belongsTo('App\Category');
        }
    // usersテーブルとのリレーション
    public function user()
        {
            return $this->belongsTo('App\User');
        }

}