<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnStep5AndTodo5OnChildStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('child_steps', function (Blueprint $table) {
         $table->dropColumn('step5');
         $table->dropColumn('todo5');
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
       $table->string('step5')->nullable();
       $table->string('todo5')->nullable();
       });
     }
}
