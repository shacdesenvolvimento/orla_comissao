<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegraComissaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regra_comissaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('quant_meses');
            $table->decimal('valor_minimo', 10, 2);   
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
        Schema::dropIfExists('regra_comissaos');
    }
}
