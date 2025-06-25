<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_coordinators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schoolyear_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('yearlevel')->nullable();
            $table->string('subject')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('course_coordinators');
    }
}
