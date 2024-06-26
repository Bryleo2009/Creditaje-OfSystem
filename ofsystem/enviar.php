<?php
header("Content-Type: application/json");
$redireccion = "../";

$log = __DIR__ . '/../api/log.php';
$data['log'] = "";

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['service'])  && !empty($_POST['idCliente'])){
    //variables del formulario
    $nombre = $_POST['name'];
    $mail = $_POST['email'];
    $servicio = $_POST['service'];
    $idCliente = $_POST['idCliente'];
    //$mensaje = $_POST['msg'];
    //$cel = $_POST['telefono'];
    $fecha = date('d/m/Y', time());
    $correoBase = "Of System <info@ofsystem.com.pe>";

    //variables del e-mail
    $correoDestino = $correoBase;
    $asunto = "Solicitud de Servicio - " . $servicio;

    //cuerpo del e-mail
    $html_reclutador = require('email/reclutador.php');
    $html_postulante = require('email/cliente.php');

    /*
    //variables del archivo
    $nameFile = $_FILES['archivo_fls']['name'];
    $sizeFile = $_FILES['archivo_fls']['size'];
    $typeFile = $_FILES['archivo_fls']['type'];
    $tempFile = $_FILES['archivo_fls']['tmp_name'];
    */


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
        $respuesta_reclutador = "correo enviado exitosamente a [$correoDestino]" ;
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
    echo json_encode(["status" => "success", "message" => $respuesta]);
    // $data['log'] = $respuesta;
    // $_POST['data'] = $data;
    // ob_start();
    // include($log);
    // $response = ob_get_clean();
} else {
    $respuesta = "existen campos vacios" . " nombre:" . $_POST['name'] . " email:" . $_POST['email'] . " servicio:" . $_POST['service'];
    echo json_encode(["status" => "error", "message" => $respuesta]);
    // $data['log'] = $respuesta;
    // $_POST['data'] = $data;
    // ob_start();
    // include($log);
    // $response = ob_get_clean();
}



