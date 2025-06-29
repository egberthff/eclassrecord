<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartEndYearToSchoolyears extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schoolyears', function (Blueprint $table) {
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
           // $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schoolyears', function (Blueprint $table) {
            //
        });
    }
}
