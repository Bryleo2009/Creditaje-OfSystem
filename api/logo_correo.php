<?php
// Ruta donde se almacenan las imágenes
$rutaImagenes = __DIR__ . '\..\images\logo\logo-v1.png';

$log = __DIR__ . '/log.php';
$data['log'] = "";

// Obtener el parámetro de la solicitud GET
if (isset($_GET['id_cliente'])) {
    // Nombre de la imagen solicitada
    $idCliente = $_GET['id_cliente'];

    // Verificar si la imagen existe
    if (file_exists($rutaImagenes)) {
        // Definir la ruta del archivo
        $file = __DIR__ . '/actualizar_estado_correo.php';
        $data['id'] = $idCliente;
        $data['estado_correo'] = 'READ';
        //manda data
        $_POST['data'] = $data;
        // Capturar la salida del archivo
        ob_start();
        include($file);
        $response = ob_get_clean();

        // Decodificar la respuesta JSON
        $response_data = json_decode($response, true);

        // Verificar si la decodificación fue exitosa y si el campo 'message' existe
        if (json_last_error() === JSON_ERROR_NONE && isset($response_data['message'])) {
            // Imprimir solo el mensaje
            //echo $response_data['message'];
            $data['log'] = $response_data['message'];
        } else {
            echo 'Error al decodificar la respuesta JSON o el campo "message" no existe';
        }

        $_POST['data'] = $data;
        ob_start();
        include($log);
        $response = ob_get_clean();
        //echo $response;
        
        // Devolver la imagen al navegador
        header('Content-Type: image/png'); // Establece el tipo MIME como imagen PNG
        readfile($rutaImagenes);
    }
}

// Si la imagen no se encuentra o no se proporciona el parámetro 'id_cliente', devuelve un código de estado 404
http_response_code(404);
exit;
