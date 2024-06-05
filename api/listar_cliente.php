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

//verificar si me enviaron el parametro id y es un numero

if (isset($_GET['rpktc'])) {
    $id = $_GET['rpktc'];
    //tiene la forma id + 'CTL' separa el id
    $id = explode('CTL', $id)[0];
    if(is_numeric($id)){
        $sql = "SELECT * FROM tb_cliente WHERE id = $id";
    }
} else {
    $sql = "SELECT true";
}

$result = $conn->query($sql);

if ($result) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al obtener los datos: " . $conn->error]);
    http_response_code(500);
}

$conn->close();
?>
