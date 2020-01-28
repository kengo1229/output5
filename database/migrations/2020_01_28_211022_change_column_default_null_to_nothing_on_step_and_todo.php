<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDefaultNullToNothingOnStepAndTodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_steps', function (Blueprint $table) {
          $table->string('step0')->default(false)->change();
          $table->string('todo0')->default(false)->change();
          $table->string('step1')->default(false)->change();
          $table->string('todo1')->default(false)->change();

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
          $table->string('step0')->default(null)->change();
          $table->string('todo0')->default(null)->change();
        });
    }
}
