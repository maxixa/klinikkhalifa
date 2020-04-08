<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawatInapDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_inap_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rawat_inap_id')->index();
            $table->string('code');
            $table->string('teraphy');
            $table->unsignedBigInteger('teraphist_id');
            $table->string('teraphist');
            $table->integer('price');
            $table->timestamps();

            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inaps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_inap_details');
    }
}
