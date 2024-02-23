<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_med_details', function (Blueprint $table) {
            $table->id();
            $table->integer('National_id');
            $table->string("Payment_mode");
            $table->string("Hospital");
            $table->string("Policy_provider")->nullable();
            $table->string("Policy_no")->unique()->nullable();
            $table->string("Med_condition")->nullable();

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
        Schema::dropIfExists('_med_details');
    }
}
