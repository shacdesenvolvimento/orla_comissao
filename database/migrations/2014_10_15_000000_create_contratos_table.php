<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto'); 
            $table->unsignedBigInteger('id_unidade');            //user
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_lider')->nullable();
            $table->decimal('valor_contrato', 10, 2);            
            $table->date('inicio_contrato');
            $table->date('primeiro_pagamento');
            $table->bigInteger('quant_meses');
            $table->string('forma_pagamento');
            $table->bigInteger('parcelas');
            $table->unsignedBigInteger('id_regra')->nullable();
            $table->foreign('id_produto')->references('id')->on('produtos');
            $table->foreign('id_unidade')->references('id')->on('unidades');
            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_lider')->references('id')->on('users');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_regra')->references('id')->on('regra_comissaos');
            






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
        Schema::dropIfExists('contratos');
    }
}
