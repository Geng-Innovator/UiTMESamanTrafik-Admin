<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelajarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelajar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pelajar');
            $table->string('nama');
            $table->string('kursus');
            $table->string('fakulti');
            $table->string('kolej');
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
        Schema::dropIfExists('pelajar');
    }
}
