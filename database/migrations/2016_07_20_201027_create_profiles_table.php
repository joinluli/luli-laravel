<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table){
            $table->increments('id');
            $table->string('first_name', 20);
            $table->string('middle_name', 20);
            $table->string('last_name', 20);
            $table->string('industry_name', 20);
            $table->string('dp_permalink');
            $table->string('about');
            $table->string('tagline_1', 30);
            $table->string('tagline_2', 30);
            $table->string('location', 50);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('profiles');
    }
}
