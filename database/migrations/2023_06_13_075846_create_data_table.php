<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $timestamps = false;
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->string('iddesa',10)->primary();
            $table->string('namadesa');
            $table->Integer('miskin');
            $table->Integer('rentan_miskin');
            $table->Integer('sangat_miskin');
            $table->Integer('jumlah');
            $table->string('idkecamatan',7);
            $table->string('idkabkot',4);
           
        });

        Schema::table('data', function (Blueprint $table) {
            $table->foreign('idkecamatan')->references('idkecamatan')->on('kecamatans');
            $table->foreign('idkabkot')->references('idkabkot')->on('kabkots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
