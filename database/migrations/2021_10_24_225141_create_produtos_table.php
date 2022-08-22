<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nome',60);
            $table->string('descricao',500)->nullable();
            $table->string('descricao_simplificada',50)->nullable();
            $table->float('preco',8,2)->nullable();
            $table->float('precoMinimo',8,2)->nullable();
            $table->float('precoMaximo',12,2)->nullable();
            $table->float('precoMedio',12,2)->nullable();
            $table->smallInteger('quantidade')->nullable();
            $table->smallInteger('pendente')->nullable();
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
        Schema::dropIfExists('produtos');
    }
}
