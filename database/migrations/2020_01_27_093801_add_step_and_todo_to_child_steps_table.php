<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// カラムの追加
class AddStepAndTodoToChildStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_steps', function (Blueprint $table) {
            $table->string('step1');
            $table->string('todo1');
            $table->string('step2')->nullable();
            $table->string('todo2')->nullable();
            $table->string('step3')->nullable();
            $table->string('todo3')->nullable();
            $table->string('step4')->nullable();
            $table->string('todo4')->nullable();
            $table->string('step5')->nullable();
            $table->string('todo5')->nullable();
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
            $table->dropColumn('step1');
            $table->dropColumn('todo1');
            $table->dropColumn('step2');
            $table->dropColumn('todo2');
            $table->dropColumn('step3');
            $table->dropColumn('todo3');
            $table->dropColumn('step4');
            $table->dropColumn('todo4');
            $table->dropColumn('step5');
            $table->dropColumn('todo5');
        });
    }
}
