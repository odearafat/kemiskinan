<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desas', function (Blueprint $table) {
            $table->string('iddesa',10)->primary();
            $table->string('namadesa');
            $table->string('idkecamatan',7);
            $table->string('idkabkot',4);
        });

        Schema::table('desas', function (Blueprint $table) {
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
        Schema::dropIfExists('desas');
    }
}
