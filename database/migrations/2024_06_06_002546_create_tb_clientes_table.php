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
        Schema::create('tb_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 10);
            $table->string('nombre', 500);
            $table->string('email', 300);
            $table->tinyInteger('estado')->default(1);
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });

        // Ejecutar la consulta SQL para insertar datos
        $sql_insert_cliente = "INSERT INTO tb_cliente (nombre, email, estado,codigo) VALUES
                                    ('Of System', 'info@ofsystem.com.pe', 1, 'OFSYS')";
        DB::statement($sql_insert_cliente);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_cliente');
    }
};
