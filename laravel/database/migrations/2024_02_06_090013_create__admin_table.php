<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_admin', function (Blueprint $table) {
            $table->foreignId('User_id')->constrained('users');
            $table->integer('National_id')->primary();
            $table->string("Full_Names");
            $table->string("email")->unique();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_admin');
    }
}
