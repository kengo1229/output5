<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnStepAndTodoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_steps', function (Blueprint $table) {
            $table->dropColumn('step0');
            $table->dropColumn('step1');
            $table->dropColumn('step2');
            $table->dropColumn('step3');
            $table->dropColumn('step4');
            $table->dropColumn('todo0');
            $table->dropColumn('todo1');
            $table->dropColumn('todo2');
            $table->dropColumn('todo3');
            $table->dropColumn('todo4');
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
            $table->string('step0')->default(false);
            $table->string('step1')->default(false);
            $table->string('step2')->default(false);
            $table->string('step3')->default(false);
            $table->string('step4')->default(false);
            $table->string('todo0')->default(false);
            $table->string('todo1')->default(false);
            $table->string('todo2')->default(false);
            $table->string('todo3')->default(false);
            $table->string('todo4')->default(false);
        });
    }
}
