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
        Schema::create('tb_plan_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('estado')->default(1);
            $table->foreignId('id_categ')->constrained('tb_categoria');
            $table->foreignId('id_service')->constrained('tb_services');
            $table->double('precio_es', 8, 2)->nullable();
            $table->double('precio_en', 8, 2)->nullable();
            $table->double('descuento', 8, 2)->nullable();
            $table->double('renovacion_es',8,2)->nullable();
            $table->double('renovacion_en',8,2)->nullable();
            $table->boolean('view_precio')->default(1);
            $table->boolean('view_descuento')->default(0);
            $table->boolean('view_renovacion')->default(0);
            $table->integer('paginas')->nullable();
            $table->integer('secciones')->nullable();
            $table->integer('cant_productos')->nullable();
            $table->integer('cant_correos')->nullable();
        });

        //agregar planes de servicios
        DB::table('tb_plan_services')->insert(
        [
            [
                'id' => 1,
                'id_categ' => 1,
                'id_service' => 1,
                'precio_es' => null,
                'precio_en' => null,
                'view_precio' => 0,
                'paginas' => null,
                'secciones' => null,
                'cant_correos' => null,
                'cant_productos' => null,
                'renovacion_es' => null,
                'renovacion_en' => null,
                'estado' => 0,
            ],
            [
                'id' => 2,
                'id_categ' => 2,
                'id_service' => 2,
                'precio_es' => 1250,
                'precio_en' => 328,
                'view_precio' => 1,
                'paginas' => 1,
                'secciones' => 10,
                'cant_correos' => 5,
                'cant_productos' => null,
                'renovacion_es' => 550,
                'renovacion_en' => 145,
                'estado' => 1
            ],
            [
                'id' => 3,
                'id_categ' => 3,
                'id_service' => 2,
                'precio_es' => 1750,
                'precio_en' => 459,
                'view_precio' => 1,
                'paginas' => 5,
                'secciones' => 25,
                'cant_correos' => 5,
                'cant_productos' => null,
                'renovacion_es' => 550,
                'renovacion_en' => 145  ,
                'estado' => 1             
            ],
            [
                'id' => 4,
                'id_categ' => 4,
                'id_service' => 2,
                'precio_es' => 2250,
                'precio_en' => 590,
                'view_precio' => 1,
                'paginas' => 10,
                'secciones' => 50,
                'cant_correos' => 5,
                'cant_productos' => null,
                'renovacion_es' => 550,
                'renovacion_en' => 145,
                'estado' => 1
            ],
            [
                'id' => 5,
                'id_categ' => 2,
                'id_service' => 3,
                'precio_es' => 1950,
                'precio_en' => 512,
                'view_precio' => 1,
                'paginas' => 1,
                'secciones' => 10,
                'cant_correos' => 5,
                'cant_productos' => 10,
                'renovacion_es' => 750,
                'renovacion_en' => 197,
                'estado' => 1
            ],
            [
                'id' => 6,
                'id_categ' => 3,
                'id_service' => 3,
                'precio_es' => 2450,
                'precio_en' => 642,
                'view_precio' => 1,
                'paginas' => 5,
                'secciones' => 25,
                'cant_correos' => 5,
                'cant_productos' => 20,
                'renovacion_es' => 750,
                'renovacion_en' => 197,
                'estado' => 1
            ],
            [
                'id' => 7,
                'id_categ' => 4,
                'id_service' => 3,
                'precio_es' => 2950,
                'precio_en' => 773,
                'view_precio' => 1,
                'paginas' => 10,
                'secciones' => 50,
                'cant_correos' => 5,
                'cant_productos' => 30,
                'renovacion_es' => 750,
                'renovacion_en' => 197,
                'estado' => 1
            ],
            [
                'id' => 8,
                'id_categ' => 2,
                'id_service' => 4,
                'precio_es' => 950,
                'precio_en' => 248,
                'view_precio' => 1,
                'paginas' => 1,
                'secciones' => 5,
                'cant_correos' => 1,
                'cant_productos' => null,
                'renovacion_es' => 450,
                'renovacion_en' => 119,
                'estado' => 1
            ],
            [
                'id' => 9,
                'id_categ' => 3,
                'id_service' => 4,
                'precio_es' => 1450,
                'precio_en' => 379,
                'view_precio' => 1,
                'paginas' => 1,
                'secciones' => 10,
                'cant_correos' => 1,
                'cant_productos' => null,
                'renovacion_es' => 450,
                'renovacion_en' => 119,
                'estado' => 1
            ],
            [
                'id' => 10,
                'id_categ' => 4,
                'id_service' => 4,
                'precio_es' => 1850,
                'precio_en' => 484,
                'view_precio' => 1,
                'paginas' => 1,
                'secciones' => 15,
                'cant_correos' => 1,
                'cant_productos' => null,
                'renovacion_es' => 450,
                'renovacion_en' => 119,
                'estado' => 1
            ]
        ]
    );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_plan_services');
    }
};
