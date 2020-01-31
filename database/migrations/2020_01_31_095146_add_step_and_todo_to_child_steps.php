<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStepAndTodoToChildSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_steps', function (Blueprint $table) {
            $table->string('step')->default(0);
            $table->string('todo')->default(0);
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
            $table->dropColumn('step');
            $table->dropColumn('todo');
        });
    }
}
