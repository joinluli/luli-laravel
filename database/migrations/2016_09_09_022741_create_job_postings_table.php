<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobPostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('about_job');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('pay');
            $table->string('website_link');
            $table->string('about_company');

            // indexes below
            $table->boolean('draft')->default(1)->index();
            $table->boolean('published')->default(0)->index();
            $table->integer('location_id')->unsigned()->index();
            $table->integer('job_type_id')->unsigned()->index();
            $table->integer('company_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('style_id')->unsigned()->index();
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
        Schema::drop('job_postings');
    }
}
