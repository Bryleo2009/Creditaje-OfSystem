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
        Schema::create('tb_ticket_categoria', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 500);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });

        // Ejecutar la consulta SQL para insertar datos 
        $sql_insert_ticket_categoria = "INSERT INTO tb_ticket_categoria (descripcion, estado) VALUES
                                    ('Soporte técnico', 1),
                                    ('Ventas', 1),
                                    ('Reclamo', 1)";
        DB::statement($sql_insert_ticket_categoria);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ticket_categoria');
    }
};
