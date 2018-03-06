<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePekerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerja', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('no_pekerja');
	        $table->string('password');
	        $table->string('nama');
	        $table->string('emel');
	        $table->string('no_ic');
	        $table->string('no_tel_hp');
	        $table->string('no_tel_pej');
	        $table->string('jawatan');
	        $table->string('jenis_pekerja');
	        $table->boolean('log_pertama');
            $table->rememberToken();
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
        Schema::dropIfExists('pekerja');
    }
}
