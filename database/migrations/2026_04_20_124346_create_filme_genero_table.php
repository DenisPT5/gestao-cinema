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
    Schema::create('filme_genero', function (Blueprint $table) {
        $table->unsignedInteger('id_filme');
        $table->unsignedInteger('id_genero');
        $table->primary(['id_filme', 'id_genero']);
        $table->foreign('id_filme')->references('id_filme')->on('filme')->onDelete('cascade');
        $table->foreign('id_genero')->references('id_genero')->on('genero')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filme_genero');
    }
};
