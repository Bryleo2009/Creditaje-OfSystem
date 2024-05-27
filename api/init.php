<?php
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
    die("Conexión fallida: " . $conn->connect_error);
}

// SQL para crear la tabla

$sql_tb_estado_correo = "CREATE TABLE IF NOT EXISTS tb_estado_correo (
    id VARCHAR(5) PRIMARY KEY NOT NULL UNIQUE,
    descripcion VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
)";

$sql_tb_frm_contacto = "CREATE TABLE IF NOT EXISTS tb_frm_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(500) NOT NULL,
    email VARCHAR(300) NOT NULL,
    servicio VARCHAR(150) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    estado_corre VARCHAR(5) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_lectura TIMESTAMP NULL,
    FOREIGN KEY (estado_corre) REFERENCES tb_estado_correo(id)
)";

if ($conn->query($sql_tb_estado_correo) === TRUE) {
    echo "Tabla Estado Correo creada exitosamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

if ($conn->query($sql_tb_frm_contacto) === TRUE) {
    echo "Tabla Formulario de Contacto creada exitosamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

//insertar datos en la tabla tb_estado_correo
/*$sql_insert_estado_correo = "INSERT INTO tb_estado_correo (id, descripcion, estado) VALUES
('SENT', 'Enviado', 1),
('NOSEN', 'No enviado', 1),
('READ', 'Leido', 1)";

if ($conn->query($sql_insert_estado_correo) === TRUE) {
    echo "Datos insertados en la tabla Estado Correo";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error;
}
*/

$conn->close();
?>
