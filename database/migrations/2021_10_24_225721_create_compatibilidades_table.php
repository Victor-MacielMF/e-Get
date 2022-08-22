<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompatibilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compatibilidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carac_opcao_produto_carac_id');
            $table->unsignedBigInteger('carac_opcao_produto_carac_c_id');
            $table->foreign('carac_opcao_produto_carac_id')->references('id')->on('carac_opcao_produto_carac')->onDelete('cascade');
            $table->foreign('carac_opcao_produto_carac_c_id')->references('id')->on('carac_opcao_produto_carac')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('compatibilidades');
    }
}
