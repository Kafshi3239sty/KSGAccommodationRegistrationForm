<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_course', function (Blueprint $table) {
            $table->id();
            $table->integer('National_id');
            $table->string("Course_Title");
            $table->timestamp('From')->nullable();
            $table->timestamp('To')->nullable();

            $table->foreign('National_id')->references('National_id')->on('_participants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_course');
    }
}
