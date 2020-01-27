<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//テーブル名の変更 
class RenameChallengeChildToChallengeChildStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenge_child_steps', function (Blueprint $table) {
            Schema::rename('challenge_child', 'challenge_child_steps');
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
            Schema::rename('challenge_child_steps', 'challenge_child');
        });
    }
}
