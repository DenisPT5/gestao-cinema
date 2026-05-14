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
    Schema::create('sessao', function (Blueprint $table) {
        $table->increments('id_sessao');
        $table->timestamp('data_hora');
        $table->decimal('preco_base', 5, 2);
        $table->unsignedInteger('id_filme');
        $table->unsignedInteger('id_sala');
        $table->unsignedInteger('id_funcionario')->nullable();
        $table->unique(['data_hora', 'id_sala']);
        $table->foreign('id_filme')->references('id_filme')->on('filme')->onDelete('restrict');
        $table->foreign('id_sala')->references('id_sala')->on('sala')->onDelete('restrict');
        $table->foreign('id_funcionario')->references('id_funcionario')->on('funcionario')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessoes');
    }
};
