<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//テーブル名の変更
class RenameParentStepToParentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_steps', function (Blueprint $table) {
            Schema::rename('parent_step', 'parent_steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parent_steps', function (Blueprint $table) {
            Schema::rename('parent_steps', 'parent_step');
        });
    }
}
