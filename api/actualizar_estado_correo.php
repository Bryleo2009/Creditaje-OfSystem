<?php
header("Content-Type: application/json");

// Incluir el archivo config_helper.php
require_once 'config_helper.php';

// Configurar la ruta del archivo config.env
$filepath = __DIR__ . '/../config.env';

// Cargar las configuraciones desde config.env
$config = parseEnvFile($filepath);


$servername = $config['DB_HOST'];
$username = $config['DB_USER'];
$password = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]));
}

// Obtener los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['estado_correo'])) {
    $id = $conn->real_escape_string($data['id']);
    $estado_correo = $conn->real_escape_string($data['estado_correo']);

    // SQL para actualizar el estado del correo
    $sql = "UPDATE tb_frm_contacto SET estado_corre = '$estado_correo' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Estado del correo actualizado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar el estado del correo: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}

$conn->close();
?>
