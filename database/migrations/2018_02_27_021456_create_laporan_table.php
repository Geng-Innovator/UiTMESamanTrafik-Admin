<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staf_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('polis_id')->nullable();
            $table->string('pelajar_id')->nullable();
	        $table->string('status_laporan');
	        $table->string('tempat');
            $table->string('imej_staf')->nullable();
            $table->string('imej_polis')->nullable();
            $table->string('laporan_staf')->nullable();
            $table->string('laporan_polis')->nullable();
            $table->string('no_siri_pelekat')->nullable();
            $table->string('kenderaan');
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
        Schema::dropIfExists('laporan');
    }
}
