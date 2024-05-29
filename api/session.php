<?php
session_start(); // Iniciar la sesión

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

if (isset($data['email']) && isset($data['password'])) {
    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);

    // Realizar una consulta para obtener la contraseña del usuario
    $query = "SELECT id, email, password FROM tb_usuario WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            // El usuario existe, obtener la contraseña almacenada
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];
            
            // Verificar si la contraseña proporcionada coincide con la almacenada
            if (password_verify($data['password'], $stored_password)) {
                // Las credenciales son válidas, iniciar sesión exitosamente
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['id'];
                $response = array('status' => 'success', 'message' => 'Inicio de sesión exitoso', 'id' => $row['id']);
            } else {
                // Contraseña incorrecta
                $_SESSION['loggedin'] = false;
                $response = array('status' => 'error', 'message' => 'La contraseña es incorrecta');
            }
        } else {
            // El usuario no existe
            $_SESSION['loggedin'] = false;
            $response = array('status' => 'error', 'message' => 'El usuario no existe');
        }
    } else {
        // Error en la consulta SQL
        $_SESSION['loggedin'] = false;
        $response = array('status' => 'error', 'message' => 'Error en la consulta SQL: ' . $conn->error);
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
