<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// parent_stepテーブルのuser_idカラムのデータ型をbigint(符号なし)に変更
class ChangeUserIdIntToBigintOnParentStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_step', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parent_step', function (Blueprint $table) {
          $table->integer('user_id')->change();
        });
    }
}
