<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComissaoPagarVendedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('comissao_pagar_vendedors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pagamentopor_contratos');
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_lider')->nullable();
            $table->string('valor_comissao_atual');
            $table->string('status');
            $table->foreign('id_pagamentopor_contratos')->references('id')->on('pagamentopor_contratos');
            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_lider')->references('id')->on('users');

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
        Schema::dropIfExists('comissao_pagar_vendedors');
    }
}
