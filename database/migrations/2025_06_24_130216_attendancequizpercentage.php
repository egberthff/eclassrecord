<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dynamic_percentage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('curriculum_subject_id')->nullable();
            $table->float('attendance_percentage')->nullable(); 
            $table->float('quiz_percentage')->nullable();
            $table->string('course_term')->nullable();
            $table->string('schoolyear_id')->nullable();
            $table->string('school_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('semester')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_percentage');
    }
};
