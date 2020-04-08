<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObatHerbalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_herbal_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('obat_herbal_id')->index();
            $table->string('code');
            $table->string('name');
            $table->integer('qty');
            $table->integer('price');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('obat_herbal_id')->references('id')->on('obat_herbals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obat_herbal_details');
    }
}
