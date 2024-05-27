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

if (isset($data['name']) && isset($data['email']) && isset($data['service'])) {
    $nombre = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);
    $servicio = $conn->real_escape_string($data['service']);

    // SQL para insertar el registro
    $sql = "INSERT INTO tb_frm_contacto (nombre, email, servicio, estado_corre, fecha_registro) VALUES ('$nombre', '$email', '$servicio', 'NOSEN', current_timestamp())";

    if ($conn->query($sql) === TRUE) {
        $insert_id = $conn->insert_id;
        echo json_encode(["status" => "success", "message" => "Registro guardado exitosamente", "id" => $insert_id]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al guardar el registro: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}

$conn->close();
?>
