<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('schoolyear_id')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('a1')->nullable();
            $table->string('a2')->nullable();
            $table->string('a3')->nullable();
            $table->string('a4')->nullable();
            $table->string('a5')->nullable();
            $table->string('b1')->nullable();
            $table->string('b2')->nullable();
            $table->string('b3')->nullable();
            $table->string('b4')->nullable();
            $table->string('b5')->nullable();
            $table->string('c1')->nullable();
            $table->string('c2')->nullable();
            $table->string('c3')->nullable();
            $table->string('c4')->nullable();
            $table->string('c5')->nullable();
            $table->string('d1')->nullable();
            $table->string('d2')->nullable();
            $table->string('d3')->nullable();
            $table->string('d4')->nullable();
            $table->string('d5')->nullable();
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
        Schema::dropIfExists('evaluation_values');
    }
}
