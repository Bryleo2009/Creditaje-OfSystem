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
        Schema::create('tb_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre_es');
            $table->string('descripcion_es')->nullable();
            $table->string('nombre_en')->nullable();
            $table->string('descripcion_en')->nullable();
            $table->boolean('estado')->default(1);
        });

        //crear Web Profesional, Tienda Online, Landing Page
        DB::table('tb_services')->insert([
            [
                'id' => 1,
                'nombre_es' => '',
                'descripcion_es' => '',
                'nombre_en' => '',
                'descripcion_en' => '',
                'estado' => 0
            ],
            [
                'id' => 2,
                'nombre_es' => 'Web Profesional',
                'descripcion_es' => 'Presenta tus servicios profesionales de manera clara y convincente, captando la atención de clientes potenciales y estableciendo tu credibilidad en el mercado.',
                'nombre_en' => 'Professional Web',
                'descripcion_en' => 'Present your professional services in a clear and convincing way, capturing the attention of potential clients and establishing your credibility in the market.',
                'estado' => 1
            ],
            [
                'id' => 3,
                'nombre_es' => 'Tienda Online',
                'descripcion_es' => 'Abre las puertas de tu negocio al mundo digital y permite a tus clientes comprar tus productos o servicios en línea desde la comodidad de sus hogares.',
                'nombre_en' => 'Online Store',
                'descripcion_en' => 'Open the doors of your business to the digital world and allow your customers to buy your products or services online from the comfort of their homes.',
                'estado' => 1
            ],
            [
                'id' => 4,
                'nombre_es' => 'Landing Page',
                'descripcion_es' => 'Captura la atención de tus visitantes y conviértelos en clientes potenciales con una página de aterrizaje optimizada y enfocada en una única oferta o llamada a la acción.',
                'nombre_en' => 'Landing Page',
                'descripcion_en' => 'Capture the attention of your visitors and turn them into potential customers with an optimized landing page focused on a single offer or call to action.',
                'estado' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_services');
    }
};
