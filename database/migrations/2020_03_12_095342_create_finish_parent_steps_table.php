<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishParentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_parent_steps', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('title',40);
          $table->integer('goal_time');
          $table->integer('total_time');
          $table->integer('category_id');
          $table->string('description',200);
          $table->string('pic')->nullable();
          $table->unsignedBigInteger('create_step_user_id');
          $table->unsignedBigInteger('challenge_user_id');
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
        Schema::dropIfExists('finish_parent_steps');
    }
}
