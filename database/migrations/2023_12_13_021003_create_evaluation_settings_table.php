<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schoolyear_id')->nullable();
            $table->integer('peer_enabled')->default(0);
            $table->integer('self_enabled')->default(0);
            $table->integer('students_enabled')->default(0);
            $table->integer('dean_enabled')->default(0);
            $table->integer('peer_percentage')->default(0);
            $table->integer('self_percentage')->default(0);
            $table->integer('students_percentage')->default(0);
            $table->integer('dean_percentage')->default(0);
            $table->string('firstsem_enabled')->default(0);
            $table->string('secondsem_enabled')->default(0);
            $table->string('department')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('reviewer_designation')->nullable();
            $table->string('campus_director')->nullable();
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
        Schema::dropIfExists('evaluation_settings');
    }
}
