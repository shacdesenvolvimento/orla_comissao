<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoporContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentopor_contratos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_lider');
            $table->string('valor_parcela');
            $table->string('total_atual');
            $table->string('quant_parcela_atual');
            $table->date('data_pagamento');    
                               
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
        Schema::dropIfExists('pagamentopor_contratos');
    }
}
