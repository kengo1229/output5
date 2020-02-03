<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeChildStepIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_child_steps', function (Blueprint $table) {
          $table->unsignedBigInteger('child_step_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenge_child_steps', function (Blueprint $table) {
          $table->Integer('child_step_id')->nullable(false)->change();
        });
    }
}
