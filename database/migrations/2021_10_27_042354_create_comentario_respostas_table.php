<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comentario_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('comentario',500);
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
        Schema::dropIfExists('comentario_respostas');
    }
}
