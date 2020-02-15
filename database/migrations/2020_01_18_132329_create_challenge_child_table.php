<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// テーブル作成
class CreateChallengeChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenge_child', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('challenge_parent_step_id');
            $table->integer('child_step_id');
            $table->tinyInteger('end_flg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenge_child');
    }
}
