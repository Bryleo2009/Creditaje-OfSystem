<?php

namespace App\Http\Controllers;

use App\Models\tbCategoria;
use App\Models\tbService;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class Correo extends Controller
{
    //coger parametros name, email, service, idCliente
    public function enviarFrmContacto(Request $request)
    {
        date_default_timezone_set('America/Lima');
        if (!empty($request->nombre) && !empty($request->email) && !empty($request->idCliente)) {
            $nombre = $request->nombre;
            $mail = $request->email;
            $id_service = $request->id_service;
            $id_catego = $request->id_catego;
            $idCliente = $request->idCliente;
            $fecha = date('d/m/Y', time());

            $servicio = tbService::find($id_service)->nombre_es;
            if($servicio){
                $servicio = " | ".$servicio;
            } else {
                $servicio = "";
            }
            $categoria = tbCategoria::find($id_catego)->nombre_es;
            if($categoria){
                $categoria = " - ".$categoria;
            } else {
                $categoria = "";
            }

            try {

                $correoBase = "Of System <info@ofsystem.com.pe>";

                //variables del e-mail
                $correoDestino = $correoBase;
                $asunto = "Solicitud de Servicio" . $servicio. $categoria;

                //cuerpo del e-mail
                //$html_reclutador = require('email/reclutador.php');
                $html_postulante = view('email.cliente', ['nombre' => $nombre, 'idCliente' => $idCliente])->render();

                
                //si se envia un archivo
                if(isset($_FILES['archivo_fls']) && $_FILES['archivo_fls']['error'] == 0){
                    $nameFile = $_FILES['archivo_fls']['name'];
                    $sizeFile = $_FILES['archivo_fls']['size'];
                    $typeFile = $_FILES['archivo_fls']['type'];
                    $tempFile = $_FILES['archivo_fls']['tmp_name'];
                } else {
                    $sizeFile = 0;
                }         
                


                /*************E-mail a reclutador */
                //Mensaje en formato Multipart MIME -> cabecera
                $cabecera = "MIME-VERSION: 1.@\r\n";
                $cabecera .= "Content-type: multipart/mixed;";
                $cabecera .= "boundary=\"=O=F=S=Y=S=T=E=M=\"\r\n"; //SE USA COMO SEPARADOR DE PARTES DEL EMAIL
                $cabecera .= "From: {$nombre} <$mail>";

                //Primera parte del cuerpo
                $cuerpo = "--=O=F=S=Y=S=T=E=M=\r\n";
                $cuerpo .= "Content-type: text/html;";
                $cuerpo .= "charset=UTF-8\r\n";
                $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
                $cuerpo .= "\r\n";
                //$cuerpo .= $html_reclutador;
                $cuerpo .= "<h1>Nombre: {$nombre} - idCliente {$idCliente}</h1>";

                $cuerpo .= "\r\n";

                if ($sizeFile > 0) { //si envia archivo
                    //Segunda parte del cuerpo (archivo adjunto)
                    $cuerpo .= "--=O=F=S=Y=S=T=E=M=\r\n";
                    $cuerpo .= "Content-type: application/octet-stream;";
                    $cuerpo .= "name=" . $nameFile . "\r\n";
                    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
                    $cuerpo .= "Content-Disposition: attachment\r\n";
                    $cuerpo .= "filename=" . $nameFile . "\r\n";
                    $cuerpo .= "\r\n";

                    $fp = fopen($tempFile, "rb"); //nombre temporal
                    $file = fread($fp, $sizeFile);
                    $file = chunk_split(base64_encode($file)); //codifica el archivo

                    $cuerpo .= "$file\r\n";
                    $cuerpo .= "\r\n";
                }

                $cuerpo .= "--=O=F=S=Y=S=T=E=M=--\r\n"; //delimitador de todo el archivo

                //validación de envio
                if (mail($correoDestino, $asunto, $cuerpo, $cabecera)) {
                    $respuesta_reclutador = "correo enviado exitosamente a [$correoDestino]";
                } else {
                    $respuesta_reclutador = "correo no enviado a [$correoDestino]";
                }


                /*************E-mail a postulante */
                //variables del e-mail
                $correoDestino = "$nombre <$mail>";
                $asunto = "Solicitud de Servicio";


                //Mensaje en formato Multipart MIME -> cabecera
                $cabecera = "MIME-VERSION: 1.@\r\n";
                $cabecera .= "Content-type: multipart/mixed;";
                $cabecera .= "boundary=\"=O=F=S=Y=S=T=E=M=\"\r\n"; //SE USA COMO SEPARADOR DE PARTES DEL EMAIL
                $cabecera .= "From: {$correoBase}";

                //Primera parte del cuerpo
                $cuerpo = "--=O=F=S=Y=S=T=E=M=\r\n";
                $cuerpo .= "Content-type: text/html;";
                $cuerpo .= "charset=UTF-8\r\n";
                $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
                $cuerpo .= "\r\n";
                $cuerpo .= $html_postulante;
                //$cuerpo .= "<h1>Nombre: {$nombre}  - idCliente {$idCliente}</h1>";

                $cuerpo .= "\r\n";

                $cuerpo .= "--=O=F=S=Y=S=T=E=M=--\r\n"; //delimitador de todo el archivo

                //validación de envio
                if (mail($correoDestino, $asunto, $cuerpo, $cabecera)) {
                    $respuesta_postulante = "correo enviado exitosamente a [$correoDestino]";
                } else {
                    $respuesta_postulante = "correo no enviado a [$correoDestino]";
                }

                $respuesta = $respuesta_reclutador . ' | ' . $respuesta_postulante;

                Log::info($respuesta);

                return response()->json(["status" => "success", "message" => $respuesta]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                http_response_code(500);
                $respuesta = "error al enviar correo " . $e->getMessage();
                return response()->json(["status" => "error", "message" => $respuesta]);
            }
        } else {
            $respuesta = "existen campos vacios" . " nombre:" . $request->nombre . " email:" . $request->email . " servicio:" . $request->servicio . " idCliente:" . $request->idCliente;
            Log::error($respuesta);
            http_response_code(500);
            return response()->json(["status" => "error", "message" => $respuesta]);
        }
        
    }
}
