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
        Schema::create('tb_ticket_archivo_adjunto', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id');
            $table->text('ruta');
            $table->tinyInteger('estado')->default(1);
            $table->string('nombre', 150)->nullable();
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns

            $table->foreign('ticket_id')->references('id')->on('tb_ticket');
            $table->index('ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ticket_archivo_adjunto');
    }
};
