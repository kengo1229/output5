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
        Schema::create('challenge_child_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('challenge_parent_step_id');
            $table->unsignedBigInteger('child_step_id');
            $table->integer('num_child_step')->nullable(false);
            $table->integer('passed_time')->nullable(false)->default(false);
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
        Schema::dropIfExists('challenge_child_steps');
    }
}