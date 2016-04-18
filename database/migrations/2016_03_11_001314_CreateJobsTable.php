<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('replacement_id')->unsigned()->nullable();
            $table->integer('price')->unsigned();

            $table->string('title');
            $table->string('company_name');
            $table->string('email');
            $table->string('url');
            $table->string('logo')->nullable();
            $table->string('location');
            $table->string('application_method');
            $table->string('session_token', 40);
            $table->string('edit_token', 40);

            $table->text('description');

            $table->boolean('is_featured');
            $table->boolean('is_remote');
            $table->boolean('is_active');
            $table->boolean('is_paid');
            $table->boolean('is_rejected');

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
        Schema::drop('jobs');
    }
}
