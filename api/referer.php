<?php
// Capturar la URL de referencia
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No referer';

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

date_default_timezone_set('America/Lima');
$fecha = date('Y-m-d H:i:s');

// Comprobar si el referer ya existe
$stmt = $conn->prepare("SELECT id, counter FROM referer_log WHERE referer = ?");
$stmt->bind_param("s", $referer);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Si el referer existe, actualizar el contador
    $stmt->bind_result($id, $counter);
    $stmt->fetch();
    $stmt->close();

    $counter++;
    $update_stmt = $conn->prepare("UPDATE referer_log SET counter = ?, fecha_registro = '$fecha' WHERE id = ?");
    $update_stmt->bind_param("ii", $counter, $id);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // Si el referer no existe, insertar un nuevo registro
    $stmt->close();
    $insert_stmt = $conn->prepare("INSERT INTO referer_log (referer, counter, fecha_registro) VALUES (?, 1,'$fecha')");
    $insert_stmt->bind_param("s", $referer);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$conn->close();
?>
