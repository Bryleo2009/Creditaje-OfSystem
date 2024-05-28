<?php
header("Content-Type: application/json");

// Función para leer el archivo config.env
require_once 'config_helper.php';

// Configurar la ruta del directorio de registro
$logDirectory = __DIR__ . '/../logs/';

// Crear el directorio si no existe
if (!file_exists($logDirectory)) {
    mkdir($logDirectory, 0755, true);
}

// Obtener la fecha y hora actual para el nombre del archivo de registro
$now = new DateTime();
$filename = $now->format('Y-m-d') . '_log.txt';
$filepath = $logDirectory . $filename;

//fecha y hora local peruana
date_default_timezone_set('America/Lima');
$fecha = date('d/m/Y H:i:s', time());


// Obtener los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['log'])) {
    $log = $fecha + ": "  + $data['log'];

    // Escribir el log en el archivo de registro
    file_put_contents($filepath, $log, FILE_APPEND | LOCK_EX);

    echo json_encode(["status" => "success", "message" => "Log guardado correctamente"]);
} else {
    // Obtener los datos POST
    $data = $_POST['data'];
    //conveirtelo en array
    $data = json_encode($data);

    // Decodificar el JSON a un array asociativo de PHP
    $dataArray = json_decode($data, true);

    // Verificar si la decodificación fue exitosa y si el campo 'log' está presente
    if (json_last_error() === JSON_ERROR_NONE && isset($dataArray['log'])) {

        if ($dataArray['log'] !== "") {
            $log = $fecha + ": "  + $dataArray['log'];
            file_put_contents($filepath, $log . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        // Responder con un mensaje de éxito
        echo json_encode(["status" => "success", "message" => "Log guardado correctamente"]);
    } else {
        // Responder con un mensaje de error si la decodificación falló o el campo 'log' no está presente
        echo json_encode(["status" => "error", "message" => "Datos del log incompletos o JSON inválido"]);
    }
}
