<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNullToNotNullOnStepAndTodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_steps', function (Blueprint $table) {
          $table->string('step1')->nullable(false)->change();
          $table->string('step2')->nullable(false)->change();
          $table->string('step3')->nullable(false)->change();
          $table->string('step4')->nullable(false)->change();
          $table->string('todo1')->nullable(false)->change();
          $table->string('todo2')->nullable(false)->change();
          $table->string('todo3')->nullable(false)->change();
          $table->string('todo4')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('child_steps', function (Blueprint $table) {
          $table->string('step1')->nullable()->change();
          $table->string('step2')->nullable()->change();
          $table->string('step3')->nullable()->change();
          $table->string('step4')->nullable()->change();
          $table->string('todo1')->nullable()->change();
          $table->string('todo2')->nullable()->change();
          $table->string('todo3')->nullable()->change();
          $table->string('todo4')->nullable()->change();
        });
    }
}
