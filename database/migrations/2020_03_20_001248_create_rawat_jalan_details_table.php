<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawatJalanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_jalan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rawat_jalan_id')->index();
            $table->string('code');
            $table->string('teraphy');
            $table->string('terapist');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('rawat_jalan_id')->references('id')->on('rawat_jalans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_jalan_details');
    }
}
