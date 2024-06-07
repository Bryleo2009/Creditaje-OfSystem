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
        Schema::create('tb_ticket', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('cliente_id');
            $table->string('asunto', 500);
            $table->text('descripcion');
            $table->unsignedBigInteger('prioridad');
            $table->unsignedBigInteger('categoria');
            $table->unsignedBigInteger('estado');
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns

            $table->foreign('cliente_id')->references('id')->on('tb_cliente');
            $table->foreign('prioridad')->references('id')->on('tb_ticket_prioridad');
            $table->foreign('categoria')->references('id')->on('tb_ticket_categoria');
            $table->foreign('estado')->references('id')->on('tb_ticket_estado');

            $table->index('cliente_id');
            $table->index('prioridad');
            $table->index('categoria');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ticket');
    }
};
