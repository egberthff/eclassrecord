<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculumSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schoolyear_id')->nullable();
            $table->integer('year')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('curriculum_id')->nullable();
            $table->string('subject_code')->nullable();
            $table->string('subject_desc')->nullable();
            $table->string('lec_units')->nullable();
            $table->string('lab_units')->nullable();
            $table->string('total_units')->nullable();
            $table->string('pre_reqs')->nullable();
            $table->string('mt')->nullable();
            $table->string('ft')->nullable();
            $table->string('fg')->nullable();
            $table->string('re')->nullable();
            $table->integer('status')->default(1);
            $table->integer('faculty_id')->nullable();
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
        Schema::dropIfExists('curriculum_subjects');
    }
}
