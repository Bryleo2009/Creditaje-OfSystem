<?php

namespace App\Http\Controllers;

use App\Models\tbCliente;
use App\Models\tbTicket;
use App\Models\tbTicketArchivoAdjunto;
use App\Models\tbTicketCategoria;
use App\Models\tbTicketComentario;
use App\Models\tbTicketEstado;
use App\Models\tbTicketPrioridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TicketController extends Controller
{
    //va a aceptar un parametro ?ofsys=1CLT1
    public function frmTicket(Request $request)
    {
        $ofsys = $request->ofsys;
        $idCLT = explode('CLT', $ofsys)[0];
        $view = false;
        if ($request->id) {
            $idTck = $request->id;
            //listar solo 1 ticket
            $ticket = tbTicket::find($idTck);
            $categorias = tbTicketCategoria::find($ticket->categoria);
            $prioridades = tbTicketPrioridad::find($ticket->prioridad);
            $estado = tbTicketEstado::find($ticket->estado);
            $cliente = tbCliente::find($idCLT);
            $archivos = tbTicketArchivoAdjunto::where('ticket_id', $idTck)->where('estado', 1)->get();
            $comentarios = tbTicketComentario::where('ticket_id', $idTck)->where('estado', 1)
            ->orderBy('created_at', 'desc')
            ->get();

            //recorre los comentarios y agrega el objeto cliente
            foreach ($comentarios as $comentario) {
                $comentario->cliente_id = tbCliente::find($comentario->cliente_id);
            }

            $view = true;
        } else {
            //crear nuevo ticket
            $categorias = tbTicketCategoria::where('estado', 1)->get();
            $prioridades = tbTicketPrioridad::where('estado', 1)->get();
            //si id es un numero
            if (!is_numeric($idCLT)) {
                $cliente = new tbCliente();
                $cliente->id = 0;
                $cliente->nombre = 'Recargue la página o acceda desde la página de origen';
            } else {
                $cliente = tbCliente::find($idCLT);
            }

            $ticket = new tbTicket();
            $ticket->id = 0;
            $estado = new tbTicketEstado();
            $estado->id = 0;
            $archivos = [];
            $comentarios = [];
        }

        return view('pages.ticket.ticket', [
            'ticket' => $ticket,
            'categorias' => $categorias,
            'prioridades' => $prioridades,
            'estados' => $estado,
            'cliente' => $cliente,
            'archivos' => $archivos,
            'comentarios' => $comentarios,
            'ofsys' => $ofsys,
            'view' => $view 
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
        //if no contiene CLT, no es un cliente
        if (!str_contains($ofsys, 'CLT')) {
            return redirect('/');
        }
        $id = explode('CLT', $ofsys)[0];
        $tickets = tbTicket::where('cliente_id', $id)
            ->where('estado', '!=', 5)
            ->orderBy('created_at', 'desc')
            ->get();

        //recorre los tickets y agrega el objeto prioridad, estado, categoria
        foreach ($tickets as $ticket) {
            $ticket->prioridad = tbTicketPrioridad::find($ticket->prioridad);
            $ticket->categoria = tbTicketCategoria::find($ticket->categoria);
            $ticket->estado = tbTicketEstado::find($ticket->estado);
        }

        return view('pages.ticket.cliente', [
            'tickets' => $tickets,
            'ofsys' => $ofsys
        ]);
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
        try {
            $ticket = tbTicket::find($id);
            $ticket->estado = 5;
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
            return response()->json(["status" => "success", "message" => "Eliminado"]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function guardar(Request $request, $ofsys)
    {
        try {
            $id = explode('CLT', $ofsys)[0];
            //serie = timestamp hora peruana + id + TCK
            date_default_timezone_set('America/Lima');
            // Obtener la fecha y hora actual en Perú en el formato deseado
            $hora_peruana = date('YmdHis');

            // Ahora puedes concatenar $hora_peruana con $id y 'TCK' para formar tu serie
            $serie = $hora_peruana . '-' . $id . 'TCK';

            $ticket = new tbTicket();
            $ticket->id = $serie;
            $ticket->cliente_id = $id;
            $ticket->asunto = $request->asunto;
            $ticket->descripcion = $request->descripcion;
            $ticket->prioridad = $request->prioridad;
            $ticket->categoria = $request->categoria;
            $ticket->estado = 1;
            $ticket->save();

            if ($request->archivos) {
                $archivos = $request->archivos;
                foreach ($archivos as $archivo) {
                    $adjunto = new tbTicketArchivoAdjunto();
                    $adjunto->ticket_id = $ticket->id;
                    $adjunto->nombre = $archivo['nombre'];
                    $adjunto->ruta = $archivo['ruta'];
                    $adjunto->save();
                }
            }

            if ($request->comentarios) {
                $comentarios = $request->comentarios;
                foreach ($comentarios as $comentario) {
                    $coment = new tbTicketComentario();
                    $coment->ticket_id = $ticket->id;
                    $coment->comentario = $comentario['comentario'];
                    $coment->cliente_id = $id;
                    $coment->save();
                }
            }
            return response()->json(["status" => "success", "message" => $serie]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }



    public function uploadImage(Request $request)
    {
        $image = $request->file('image');
        $upload = Cloudinary::upload($image->getRealPath(), [
            'folder' => 'your_folder', // Opcional: define una carpeta en Cloudinary
            'public_id' => 'desired_public_id' // Opcional: define un ID público personalizado
        ]);

        // Aquí puedes manejar la respuesta de Cloudinary
        // Por ejemplo, puedes almacenar la URL de la imagen en tu base de datos
    }

    public function guardarComentario(Request $request,$ofsys, $idTck)
    {
        try {
            $comentario = new tbTicketComentario();
            $comentario->ticket_id = $idTck;
            $comentario->comentario = $request->comentario;
            $comentario->cliente_id = $ofsys;
            $comentario->save();
            return response()->json(["status" => "success"]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}
