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

// Obtener los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['log'])) {
    $log = $data['log'];

    // Escribir el log en el archivo de registro
    file_put_contents($filepath, $log, FILE_APPEND | LOCK_EX);

    echo json_encode(["status" => "success", "message" => "Log guardado correctamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}
?>
