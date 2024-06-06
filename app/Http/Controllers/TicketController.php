<?php

namespace App\Http\Controllers;

use App\Models\tbCliente;
use App\Models\tbTicket;
use App\Models\tbTicketArchivoAdjunto;
use App\Models\tbTicketCategoria;
use App\Models\tbTicketComentario;
use App\Models\tbTicketPrioridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    //va a aceptar un parametro ?ofsys=1CLT1
    public function frmTicket(Request $request)
    {
        $ofsys = $request->ofsys;
        $id = explode('CLT', $ofsys)[0];

        $categorias = tbTicketCategoria::where('estado', 1)->get();
        $prioridades = tbTicketPrioridad::where('estado', 1)->get();

        //si id es un numero
        if (!is_numeric($id)) {
            $cliente = new tbCliente();
            $cliente->id = 0;
            $cliente->nombre = 'Recargue la página o acceda desde la página de origen';
        } else {
            $cliente = tbCliente::find($id);   
        }     

        //que me devuelva la pagina con los datos del cliente
        return view('pages.ticket.ticket', [
            'categorias' => $categorias,
            'prioridades' => $prioridades,
            'cliente' => $cliente,
            'ofsys' => $ofsys
        ]);
    }



    public function listar()
    {
        $ticket = tbTicket::where('estado', 1)->get();
        return response()->json($ticket);
    }

    public function listarCliente(Request $request)
    {
        $ofsys = $request->ofsys;
        $id = explode('CLT', $ofsys)[0];
        $tickets = tbTicket::where('cliente_id', $id)
            ->where('estado', 1)
            ->get();

        return view('pages.ticket.cliente', [
            'tickets' => $tickets,
            'ofsys' => $ofsys
        ]);
    }

    public function listarId($id)
    {
        $tickets = DB::table('tb_ticket as tt')
            ->select(
                'tt.id',
                'tt.asunto',
                'tt.descripcion',
                'tt.fecha_registro',
                'tc.id as cliente_id',
                'tc.nombre as cliente_nombre',
                'ttp.descripcion as prioridad',
                'ttc.descripcion as categoria',
                'tte.descripcion as estado',
                DB::raw('COALESCE(archivos.archivos, "[]") as archivos'),
                DB::raw('COALESCE(comentarios.comentarios, "[]") as comentarios')
            )
            ->join('tb_cliente as tc', function ($join) {
                $join->on('tc.id', '=', 'tt.cliente_id')
                     ->where('tc.estado', '=', 1);
            })
            ->join('tb_ticket_prioridad as ttp', function ($join) {
                $join->on('ttp.id', '=', 'tt.prioridad')
                     ->where('ttp.estado', '=', 1);
            })
            ->join('tb_ticket_categoria as ttc', function ($join) {
                $join->on('ttc.id', '=', 'tt.categoria')
                     ->where('ttc.estado', '=', 1);
            })
            ->join('tb_ticket_estado as tte', function ($join) {
                $join->on('tte.id', '=', 'tt.estado')
                     ->where('tte.estado', '=', 1);
            })
            ->leftJoin(DB::raw('(
                SELECT ticket_id, COALESCE(JSON_ARRAYAGG(
                    JSON_OBJECT(
                        "id", arc.id,
                        "nombre", arc.nombre,
                        "ruta", arc.ruta 
                    )
                ), "[]") AS archivos
                FROM tb_ticket_archivo_adjunto arc
                WHERE estado = 1
                GROUP BY ticket_id
            ) as archivos'), 'archivos.ticket_id', '=', 'tt.id')
            ->leftJoin(DB::raw('(
                SELECT ticket_id, COALESCE(JSON_ARRAYAGG(
                    JSON_OBJECT(
                        "id", coment.id,
                        "texto", coment.comentario,
                        "fecha", coment.fecha_registro,
                        "cliente", coment.cliente_id
                    )
                ), "[]") AS comentarios
                FROM tb_ticket_comentario coment
                WHERE estado = 1
                GROUP BY ticket_id
            ) as comentarios'), 'comentarios.ticket_id', '=', 'tt.id')
            ->where('tt.id', $id)
            ->groupBy('tt.id')
            ->get();

        return response()->json($tickets);
    }

    public function actualizar(Request $request, $id)
    {
        $ticket = tbTicket::find($id);
        $ticket->asunto = $request->asunto;
        $ticket->descripcion = $request->descripcion;
        $ticket->prioridad = $request->prioridad;
        $ticket->categoria = $request->categoria;
        $ticket->save();

        //actualizar el arreglo de archivos adjuntos
        $archivos_nuevos = $request->archivos;
        $archivos_viejos = tbTicketArchivoAdjunto::where('ticket_id', $id)->get();
        //comparalos y actulizalos o elimina los que no esten
        foreach ($archivos_viejos as $archivo_viejo) {
            $encontrado = false;
            foreach ($archivos_nuevos as $archivo_nuevo) {
                if ($archivo_viejo->id == $archivo_nuevo['id']) {
                    $encontrado = true;
                    $archivo_viejo->nombre = $archivo_nuevo['nombre'];
                    $archivo_viejo->ruta = $archivo_nuevo['ruta'];
                    $archivo_viejo->save();
                    break;
                }
            }
            if (!$encontrado) {
                $archivo_viejo->estado = 0;
                $archivo_viejo->save();
            }
        }

        //ahora con comentarios
        $comentarios_nuevos = $request->comentarios;
        $comentarios_viejos = tbTicketComentario::where('ticket_id', $id)->get();
        //comparalos y actulizalos o elimina los que no esten
        foreach ($comentarios_viejos as $comentario_viejo) {
            $encontrado = false;
            foreach ($comentarios_nuevos as $comentario_nuevo) {
                if ($comentario_viejo->id == $comentario_nuevo['id']) {
                    $encontrado = true;
                    $comentario_viejo->comentario = $comentario_nuevo['comentario'];
                    $comentario_viejo->save();
                    break;
                }
            }
            if (!$encontrado) {
                $comentario_viejo->estado = 0;
                $comentario_viejo->save();
            }
        }

        if ($ticket->id) {
            return response()->json(["status" => "success", "message" => $ticket->id]);
        } else {
            return response()->json(["status" => "error", "message" => "Error al guardar"]);
        }
    }

    public function eliminar($id)
    {
        $ticket = tbTicket::find($id);
        $ticket->estado = 0;
        $ticket->save();
        $archivos = tbTicketArchivoAdjunto::where('ticket_id', $id)->get();
        foreach ($archivos as $archivo) {
            $archivo->estado = 0;
            $archivo->save();
        }
        $comentarios = tbTicketComentario::where('ticket_id', $id)->get();
        foreach ($comentarios as $comentario) {
            $comentario->estado = 0;
            $comentario->save();
        }
    }

    public function guardar(Request $request,$ofsys)
    {
        $id = explode('CLT', $ofsys)[0];
        $ticket = new tbTicket();
        $ticket->cliente_id = $id;
        $ticket->asunto = $request->asunto;
        $ticket->descripcion = $request->descripcion;
        $ticket->prioridad = $request->prioridad;
        $ticket->categoria = $request->categoria;
        $ticket->save();

        //guardar el arreglo de archivos adjuntos
        $archivos = $request->archivos;
        foreach ($archivos as $archivo) {
            $adjunto = new tbTicketArchivoAdjunto();
            $adjunto->ticket_id = $ticket->id;
            $adjunto->nombre = $archivo['nombre'];
            $adjunto->ruta = $archivo['ruta'];
            $adjunto->save();
        }

        //guardar el arreglo de comentarios
        $comentarios = $request->comentarios;
        foreach ($comentarios as $comentario) {
            $coment = new tbTicketComentario();
            $coment->ticket_id = $ticket->id;
            $coment->comentario = $comentario['comentario'];
            $coment->cliente_id = $id;
            $coment->save();
        }

        if ($ticket->id) {
            return response()->json(["status" => "success", "message" => $ticket->id]);
        } else {
            return response()->json(["status" => "error", "message" => "Error al guardar"]);
        }
    }
}
