<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_enderecos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->string('cep',10);
            $table->string('cidade',50)->nullable();
            $table->string('estado',2)->nullable();
            $table->string('endereco',50)->nullable();
            $table->string('numero',10)->nullable();
            $table->string('complemento',50)->nullable();
            $table->string('bairro',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_enderecos');
    }
}
