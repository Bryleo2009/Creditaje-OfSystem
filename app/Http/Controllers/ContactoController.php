<?php

namespace App\Http\Controllers;

use App\Models\tbFrmContacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    //CRUD CONTACTO
    public function guardar(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $contacto = new tbFrmContacto();
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->id_service = $request->id_service;
        $contacto->id_catego = $request->id_catego;
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

    public function listarId($ofsys)
    {
        $id = explode('CLT', $ofsys)[0];
        //lista un contacto por id si es estado 1
        $contacto = tbFrmContacto::where('estado', 1)->find($id);
        return response()->json($contacto);
    }

    public function actualizar(Request $request, $ofsys)
    {
        try{
            date_default_timezone_set('America/Lima');
            $id = explode('CLT', $ofsys)[0];
            $contacto = tbFrmContacto::find($id);
            $contacto->estado_correo = $request->estado_correo;
            $contacto->fecha_lectura = $request->fecha_lectura;
            $contacto->estado = $request->estado ? $request->estado : 1;
            $contacto->save();
            return response()->json(["status" => "success", "message" => "Actualizado correctamente"]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
        
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
