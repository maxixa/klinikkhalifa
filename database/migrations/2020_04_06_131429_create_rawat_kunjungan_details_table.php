<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawatKunjunganDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_kunjungan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rawat_kunjungan_id')->index();
            $table->string('code');
            $table->string('teraphy');
            $table->unsignedBigInteger('teraphist_id');
            $table->string('teraphist');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('rawat_kunjungan_id')->references('id')->on('rawat_kunjungans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_kunjungan_details');
    }
}
