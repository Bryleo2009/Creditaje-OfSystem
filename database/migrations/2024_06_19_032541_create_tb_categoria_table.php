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
        Schema::create('tb_categoria', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_es');
            $table->string('descripcion_es')->nullable();
            $table->string('nombre_en')->nullable();
            $table->string('descripcion_en')->nullable();
            $table->string('icono')->nullable();
            $table->boolean('estado')->default(1);
        });

        //agregar Entrepreneurs ,Business , Business 
        DB::table('tb_categoria')->insert(
        [
            [
                'id' => 1,
                'nombre_es' => '',
                'descripcion_es' => '',
                'nombre_en' => '',
                'descripcion_en' => '',
                'icono' => '',
                'estado' => 0
            ],
            [
                'id' => 2,
                'nombre_es' => 'Starter Pack',
                'descripcion_es' => 'Ideal para Emprendedores y PYMES',
                'nombre_en' => 'Starter Pack',
                'descripcion_en' => 'Ideal for Entrepreneurs and SMEs',
                'icono' => 'fas fa-user-tie',
                'estado' => 1
            ],
            [
                'id' => 3,
                'nombre_es' => 'Business Pack',
                'descripcion_es' => 'Ideal para Negocios en Crecimiento',
                'nombre_en' => 'Business Pack',
                'descripcion_en' => 'Ideal for Growing Businesses',
                'icono' => 'fas fa-building',
                'estado' => 1
            ],
            [
                'id' => 4,
                'nombre_es' => 'Enterprise Pack',
                'descripcion_es' => 'Ideal para Empresas Consolidadas',
                'nombre_en' => 'Enterprise Pack',
                'descripcion_en' => 'Ideal for Established Companies',
                'icono' => 'fas fa-industry',
                'estado' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_categoria');
    }
};
