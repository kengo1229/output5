<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// テーブル作成
class CreateParentStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_steps', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('title',40);
          $table->integer('goal_time');
          $table->integer('category_id');
          $table->string('description',200);
          $table->string('pic')->nullable();
          $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('parent_steps');
    }
}