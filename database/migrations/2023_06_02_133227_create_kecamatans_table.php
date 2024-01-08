<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->string('idkecamatan',7)->primary();
            $table->string('namakecamatan');
            $table->string('idkabkot',4);
        });

        Schema::table('kecamatans', function (Blueprint $table) {
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
        Schema::dropIfExists('kecamatans');
    }
}
