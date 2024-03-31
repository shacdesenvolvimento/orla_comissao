<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegraPorContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regra_por_contratos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_regra');
            $table->unsignedBigInteger('id_vendedor');
            $table->unsignedBigInteger('id_lider');
            $table->text('permissao_comissao');           
            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->foreign('id_vendedor')->references('id')->on('users');
            $table->foreign('id_lider')->references('id')->on('users');
            $table->foreign('id_regra')->references('id')->on('regra_comissaos');

           
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regra_por_contratos');
    }
}
