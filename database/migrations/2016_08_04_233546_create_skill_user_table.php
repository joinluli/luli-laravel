<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('skill_user', function (Blueprint $table) {
          $table->integer('user_id')->unsigned()->index();
          $table->integer('skill_id')->unsigned()->index();
          $table->integer('rec_count')->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_user');
    }
}
