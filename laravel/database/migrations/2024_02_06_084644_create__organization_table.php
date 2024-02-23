<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_organization', function (Blueprint $table) {
            $table->id();
            $table->integer('National_id');
            $table->string("Spons_org");
            $table->string("Work_st");

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
        Schema::dropIfExists('_organization');
    }
}
