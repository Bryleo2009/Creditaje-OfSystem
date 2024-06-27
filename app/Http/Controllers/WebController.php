<?php

namespace App\Http\Controllers;

use App\Models\RefererLog;
use App\Models\tbCategoria;
use App\Models\tbFrmContacto;
use App\Models\tbPlanService;
use App\Models\tbService;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
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

        $referer = $request->header('referer');
        $this->procesarReferer($referer);


        return view('index', compact('servicios'));
    }

    public function credito(Request $request)
    {
        $referer = $request->header('referer');
        $this->procesarReferer($referer);

        return view('pages.creditaje');
    }

    public function logoCorreo(Request $request){
        date_default_timezone_set('America/Lima');
        $id = $request->input('id_cliente');
        $estadoCorreo = 'READ';

        $correo = tbFrmContacto::find($id);
        if ($correo && $correo->estado_correo !== 'READ') {
            $correo->estado_correo = $estadoCorreo; // Asume que $estadoCorreo es una variable que ya tienes definida
            $correo->fecha_lectura = now(); // Laravel proporciona un helper now() que es equivalente a date('Y-m-d H:i:s')
            $correo->save();
        }


        $path = public_path('images/logo/logo-v1.png');
        return response()->file($path);
    }

    protected function procesarReferer($referer)
    {
        date_default_timezone_set('America/Lima');
        if($referer){
            $referer = $referer;
        } else {
            $referer = 'No Referer';
        }
        $refererLog = RefererLog::where('referer', $referer)->first();        

        if ($refererLog) {
            // Si el referer existe, actualizar el contador
            $refererLog->increment('counter');
        } else {
            // Si el referer no existe, crear un nuevo registro
            RefererLog::create([
                'referer' => $referer,
                'counter' => 1,
            ]);
        }
    }
}
