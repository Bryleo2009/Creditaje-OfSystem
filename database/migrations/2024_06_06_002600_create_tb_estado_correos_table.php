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
        Schema::create('tb_estado_correo', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('descripcion', 500);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });

        // Ejecutar la consulta SQL para insertar datos
        $sql_insert_estado_correo = "INSERT INTO tb_estado_correo (id, descripcion, estado) VALUES
                                    ('SENT', 'Enviado', 1),
                                    ('NOSEN', 'No enviado', 1),
                                    ('READ', 'Leído', 1)";
        DB::statement($sql_insert_estado_correo);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_estado_correo');
    }
};
