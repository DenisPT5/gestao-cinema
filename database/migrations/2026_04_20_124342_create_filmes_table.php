<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('filme', function (Blueprint $table) {
        $table->increments('id_filme');
        $table->string('titulo', 100);
        $table->integer('duracao_minutos')->unsigned();
        $table->integer('ano_lancamento')->nullable();
        $table->string('realizador', 100)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
