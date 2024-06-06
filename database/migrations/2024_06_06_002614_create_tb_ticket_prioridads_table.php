<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_ticket_prioridad', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 500);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });

        // Ejecutar la consulta SQL para insertar datos
        $sql_insert_ticket_prioridad = "INSERT INTO tb_ticket_prioridad (descripcion, estado) VALUES
                                    ('Baja', 1),
                                    ('Media', 1),
                                    ('Alta', 1)";
        DB::statement($sql_insert_ticket_prioridad);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ticket_prioridad');
    }
};
