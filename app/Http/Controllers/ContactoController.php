<?php

namespace App\Http\Controllers;

use App\Models\tbFrmContacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    //CRUD CONTACTO
    public function guardar(Request $request)
    {
        $contacto = new tbFrmContacto();
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->servicio = $request->servicio;
        $contacto->estado_correo = 'NOSEN';
        $contacto->fecha_lectura = null;
        $contacto->save();
        
        if($contacto->id){
            return response()->json(["status" => "success", "message" => $contacto->id]);
        } else {
            return response()->json(["status" => "error", "message" => "Error al guardar"]);
        }

    }

    public function listar()
    {
        $contacto = tbFrmContacto::where('estado', 1)->get();
        return response()->json($contacto);
    }

    public function listarId($id)
    {
        //lista un contacto por id si es estado 1
        $contacto = tbFrmContacto::where('estado', 1)->find($id);
        return response()->json($contacto);
    }

    public function actualizar(Request $request, $id)
    {
        $contacto = tbFrmContacto::find($id);
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->servicio = $request->servicio;
        $contacto->estado_corre = $request->estado_corre;
        $contacto->fecha_lectura = $request->fecha_lectura;
        $contacto->estado = $request->estado;
        $contacto->save();
        return response()->json($contacto);
    }

    public function eliminar($id)
    {
        //cambiar estado a 0
        $contacto = tbFrmContacto::find($id);
        $contacto->estado = 0;
        $contacto->save();
        return response()->json($contacto);
    }
}
