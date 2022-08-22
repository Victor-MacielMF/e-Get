<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracOpcaoProdutoCaracTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carac_opcao_produto_carac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_carac_id', 'name')->constrained()->onDelete('cascade');
            $table->foreignId('carac_opcao_id', 'nome')->constrained()->onDelete('cascade');
            $table->float('preco', 8,2);
            $table->smallInteger('quantidade');
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
        Schema::dropIfExists('caracteristica_opcao_produto_caracteristica');
    }
}
