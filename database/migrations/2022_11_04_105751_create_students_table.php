<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schoolyear_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('id_no')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('dateofbirth')->nullable();
            $table->string('units')->nullable();
            $table->string('yearlevel')->nullable();
            $table->string('access_key')->nullable();
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
        Schema::dropIfExists('students');
    }
}
