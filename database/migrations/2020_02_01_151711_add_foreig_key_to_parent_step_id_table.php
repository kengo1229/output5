<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// 外部キーの設定
class AddForeigKeyToParentStepIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_parent_steps', function (Blueprint $table) {
          $table->foreign('parent_step_id')->references('id')->on('parent_steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenge_parent_steps', function (Blueprint $table) {
          $table->dropForeign(['parent_step_id']);
        });
    }
}
