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
    Schema::create('espectador', function (Blueprint $table) {
        $table->increments('cod_espectador');
        $table->string('nome', 100);
        $table->string('email', 100)->nullable()->unique();
        $table->string('contacto', 20)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espectadores');
    }
};
