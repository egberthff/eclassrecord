<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('date')->nullable();
            $table->string('description')->nullable();
            $table->integer('items_total')->default(1);
            $table->integer('status')->default(1);
            $table->integer('course_term')->default(1); //1 = PRELIM; 2 = MIDTERM; 3 = PRE-FINALS; 4 = FINALS;
            $table->integer('curriculum_subject_id')->nullable();
            $table->string('section')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
