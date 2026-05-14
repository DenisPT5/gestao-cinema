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
    Schema::create('auditoria_sessoes', function (Blueprint $table) {
        $table->increments('id_auditoria');
        $table->integer('id_sessao_afetada')->nullable();
        $table->timestamp('data_alteracao')->useCurrent();
        $table->string('operacao', 10)->nullable();
        $table->text('detalhes')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria_sessoes');
    }
};
