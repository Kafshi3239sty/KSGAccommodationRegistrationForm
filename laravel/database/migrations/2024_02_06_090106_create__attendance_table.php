<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Course_id')->constrained('_course');
            $table->integer('Participant_id');
            $table->integer('Admin_id')->nullable();
            $table->string('Hostels')->nullable();
            $table->string('Room_No')->nullable();
            $table->timestamp('Check_in')->nullable();
            $table->timestamp('Check_out')->nullable();
            $table->timestamp('Check_in_by')->nullable();
            $table->timestamp('Check_out_by')->nullable();

            $table->foreign('Participant_id')->references('National_id')->on('_participants');
            $table->foreign('Admin_id')->references('National_id')->on('_admin');
            $table->foreign(['Hostels', 'Room_No'])
                ->references(['Hostels', 'Room_No'])
                ->on('_hostels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_attendance');
    }
}
