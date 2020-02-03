<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeParentStepIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_parent_steps', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_step_id')->change();
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
          $table->Integer('parent_step_id')->nullable(false)->change();
        });
    }
}
