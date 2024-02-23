<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_participants', function (Blueprint $table) {
            $table->foreignId('User_id')->constrained('users');
            $table->integer('National_id')->primary();
            $table->string("Full_Names");
            $table->foreignId('Country')->constrained('nationalities');
            $table->integer('Mobile_No');
            $table->foreignId('Gender')->constrained('gender');
            $table->string('Address');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_participants');
    }
}
