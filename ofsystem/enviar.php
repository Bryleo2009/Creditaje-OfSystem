<?php
$redireccion = "../";

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['service'])){
    //variables del formulario
    $nombre = $_POST['name'];
    $mail = $_POST['email'];
    $servicio = $_POST['service'];
    //$mensaje = $_POST['msg'];
    //$cel = $_POST['telefono'];
    $fecha = date('d/m/Y', time());
    $paterno = "";

    //variables del e-mail
    $correoDestino = "R.R.H.H. <bryleo2009@hotmail.com>";
    $asunto = "Mail_server Prueba - Reclutador";

    //cuerpo del e-mail
    $html_reclutador = require('email/reclutador.php');
    $html_postulante = require('email/postulante.php');

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
    $cabecera .= "From: {$nombre} {$paterno} <$mail>";

    //Primera parte del cuerpo
    $cuerpo = "--=O=F=S=Y=S=T=E=M=\r\n";
    $cuerpo .= "Content-type: text/html;";
    $cuerpo .= "charset=UTF-8\r\n";
    $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
    $cuerpo .= "\r\n";
    $cuerpo .= $html_reclutador;

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
        $respuesta_reclutador = "correo enviado exitosamente al reclutador" ;
    } else {
        $respuesta_reclutador = "correo no enviado al reclutador";
    }


    /*************E-mail a postulante */
    //variables del e-mail
    $correoDestino = $mail;
    $asunto = "Mail_server Prueba - Postulante";

    //Mensaje en formato Multipart MIME -> cabecera
    $cabecera = "MIME-VERSION: 1.@\r\n";
    $cabecera .= "Content-type: multipart/mixed;";
    $cabecera .= "boundary=\"=O=F=S=Y=S=T=E=M=\"\r\n"; //SE USA COMO SEPARADOR DE PARTES DEL EMAIL
    $cabecera .= "From: Of System <info@ofsystem.com>";

    //Primera parte del cuerpo
    $cuerpo = "--=O=F=S=Y=S=T=E=M=\r\n";
    $cuerpo .= "Content-type: text/html;";
    $cuerpo .= "charset=UTF-8\r\n";
    $cuerpo .= "Content-Transfer-Encoding: 8bit\r\n";
    $cuerpo .= "\r\n";
    $cuerpo .= $html_postulante;

    $cuerpo .= "\r\n";

    $cuerpo .= "--=O=F=S=Y=S=T=E=M=--\r\n"; //delimitador de todo el archivo

    //validación de envio
    if (mail($correoDestino, $asunto, $cuerpo, $cabecera)) {
        $respuesta_postulante = "correo enviado exitosamente al postulante";
    } else {
        $respuesta_postulante = "correo no enviado al postulante";
    }

    $respuesta = $respuesta_reclutador . ' / ' . $respuesta_postulante;
    echo $respuesta;
} else {
    $respuesta = "existen campos vacios" . " nombre:" . $_POST['name'] . " email:" . $_POST['email'] . " servicio:" . $_POST['service'];
    echo $respuesta;
}
/*} else {
    $respuesta = "existen campos vacios" + " nombre:" + $_POST['name'] + " email:" + $_POST['email'] + " servicio:" + $_POST['service'];;
}
echo "<script>alert(' . $respuesta . ')</script>";
echo "<script> setTimeout(\"location.href='" . $redireccion . "'\",1000)</script>";*/
