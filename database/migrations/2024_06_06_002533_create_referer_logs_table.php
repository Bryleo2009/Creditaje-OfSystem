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
        Schema::create('tb_referer_log', function (Blueprint $table) {
            $table->id();
            $table->string('referer');
            $table->boolean('estado')->default(true); // Columna estado con valor por defecto 1 (true)
            $table->integer('counter')->default(1); // Columna counter con valor por defecto 1
            $table->timestamps(); // Añade created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_referer_log');
    }
};
