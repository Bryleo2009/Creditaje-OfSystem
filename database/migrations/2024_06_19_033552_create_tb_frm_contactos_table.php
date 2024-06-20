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
        Schema::create('tb_frm_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 500);
            $table->string('email', 300);
            $table->tinyInteger('estado')->default(1);
            $table->string('estado_correo', 5);
            $table->timestamp('fecha_lectura')->nullable();
            $table->unsignedBigInteger('id_service');
            $table->unsignedBigInteger('id_catego');
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
            $table->foreign('estado_correo')->references('id')->on('tb_estado_correo');
            $table->foreign('id_service')->references('id')->on('tb_services');
            $table->foreign('id_catego')->references('id')->on('tb_categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_frm_contacto');
    }
};
