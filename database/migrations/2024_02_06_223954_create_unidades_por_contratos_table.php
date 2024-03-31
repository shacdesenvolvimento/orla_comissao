<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesPorContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_por_contratos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_unidade');
            $table->foreign('id_contrato')->references('id')->on('contratos');
            $table->foreign('id_unidade')->references('id')->on('unidades');
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
        Schema::dropIfExists('unidades_por_contratos');
    }
}
