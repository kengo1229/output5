<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumClearChildStepToChallengeParentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_parent_steps', function (Blueprint $table) {
          $table->integer('num_clear_child_step')->nullable(false)->default(0);
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
          $table->dropColumn('num_clear_child_step');
        });
    }
}
