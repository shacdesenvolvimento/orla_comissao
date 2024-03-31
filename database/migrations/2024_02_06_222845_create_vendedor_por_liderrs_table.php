<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedorPorLiderrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedor_por_liderrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lider');
            $table->unsignedBigInteger('id_vendedor');
            $table->foreign('id_lider')->references('id')->on('users');
            $table->foreign('id_vendedor')->references('id')->on('users');
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
        Schema::dropIfExists('vendedor_por_liderrs');
    }
}
