<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNOKTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_n_o_k', function (Blueprint $table) {
            $table->id();
            $table->foreignId('User_id')->constrained('users');
            $table->string("Full_Names");
            $table->string('Relationship');
            $table->integer('Mobile_No');
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
        Schema::dropIfExists('_n_o_k');
    }
}
