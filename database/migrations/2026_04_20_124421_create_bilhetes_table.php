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
    Schema::create('bilhete', function (Blueprint $table) {
        $table->increments('num_bilhete');
        $table->decimal('preco', 5, 2);
        $table->timestamp('data_compra')->useCurrent();
        $table->string('tipo_compra', 20);
        $table->unsignedInteger('id_sessao');
        $table->unsignedInteger('cod_espectador')->nullable();
        $table->foreign('id_sessao')->references('id_sessao')->on('sessao')->onDelete('restrict');
        $table->foreign('cod_espectador')->references('cod_espectador')->on('espectador')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bilhetes');
    }
};
