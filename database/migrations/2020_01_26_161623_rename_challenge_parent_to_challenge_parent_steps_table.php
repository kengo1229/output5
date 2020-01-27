<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//テーブル名の変更
class RenameChallengeParentToChallengeParentStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_parent_steps', function (Blueprint $table) {
            Schema::rename('challenge_parent', 'challenge_parent_steps');
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
            Schema::rename('challenge_parent_steps', 'challenge_parent');
        });
    }
}
