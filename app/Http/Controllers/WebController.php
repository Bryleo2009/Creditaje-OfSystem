<?php

namespace App\Http\Controllers;

use App\Models\tbCategoria;
use App\Models\tbPlanService;
use App\Models\tbService;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        //listar servicios con estado 1;
        $servicios = tbService::where('estado', 1)->get();
        //listar categorias con estado 1;
        $categorias = tbCategoria::where('estado', 1)->get();

        // Iterar sobre cada servicio
        foreach ($servicios as $servicio) {
            // Inicializar un array para almacenar las categorías de este servicio
            $categoriasServicio = [];

            // Iterar sobre cada categoría
            foreach ($categorias as $categoria) {
                // Obtener el plan correspondiente a esta categoría y servicio
                $plan = tbPlanService::where('id_service', $servicio->id)
                    ->where('id_categ', $categoria->id)
                    ->where('estado', 1)
                    ->first();

                // Si se encuentra un plan, agregar la categoría con su plan al array de categorías del servicio
                if ($plan) {
                    if($plan->view_descuento){
                        $plan->monto_final_es = $plan->precio_es - ($plan->precio_es * $plan->descuento / 100);
                        $plan->monto_final_en = $plan->precio_en - ($plan->precio_en * $plan->descuento / 100);
                    } else {
                        $plan->monto_final_es = $plan->precio_es;
                        $plan->monto_final_en = $plan->precio_en;
                    }
                    // Clonar la categoría para evitar modificar el objeto original
                    $categoriaConPlan = $categoria->replicate();
                    $categoriaConPlan->id = $categoria->id;
                    $categoriaConPlan->plan = $plan;
                    $categoriasServicio[] = $categoriaConPlan;
                }
            }

            // Asignar el array de categorías al servicio
            $servicio->categorias = $categoriasServicio;
        }



        return view('index', compact('servicios'));
    }
}
