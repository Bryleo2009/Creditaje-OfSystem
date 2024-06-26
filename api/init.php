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

//creear tabla usuario
$sql_tb_usuario = "CREATE TABLE IF NOT EXISTS tb_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(300) NOT NULL UNIQUE,
    password VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

//crear tabla de referer
$sql_tb_referer = "CREATE TABLE IF NOT EXISTS referer_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    referer VARCHAR(255) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    counter INT DEFAULT 1
)";

//crear tabla cliente
$sql_tb_cliente = "CREATE TABLE IF NOT EXISTS tb_cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(500) NOT NULL,
    email VARCHAR(300) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sql_tb_estado_ticket = "CREATE TABLE IF NOT EXISTS tb_ticket_estado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
)";

$sql_tb_prioridad_ticket = "CREATE TABLE IF NOT EXISTS tb_ticket_prioridad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
)";

$sql_tb_categoria_ticket = "CREATE TABLE IF NOT EXISTS tb_ticket_categoria(
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(500) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1
)";

$sql_tb_ticket = "CREATE TABLE IF NOT EXISTS tb_ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    asunto VARCHAR(500) NOT NULL,
    descripcion TEXT NOT NULL,
    prioridad INT NOT NULL,
    categoria INT NOT NULL,
    estado INT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES tb_cliente(id),
    FOREIGN KEY (prioridad) REFERENCES tb_ticket_prioridad(id),
    FOREIGN KEY (categoria) REFERENCES tb_ticket_categoria(id),
    FOREIGN KEY (estado) REFERENCES tb_ticket_estado(id)
)";


//en comentario asocialo con un cliente
$sql_tb_comentario_ticket = "CREATE TABLE IF NOT EXISTS tb_ticket_comentario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    comentario TEXT NOT NULL,
    cliente_id INT NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tb_ticket(id),
    FOREIGN KEY (cliente_id) REFERENCES tb_cliente(id)
)";

$sql_tb_archivo_adjunto = "CREATE TABLE IF NOT EXISTS tb_ticket_archivo_adjunto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    archivo TEXT NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tb_ticket(id)
)";

if ($conn->query($sql_tb_estado_ticket) === TRUE) {
    echo "Tabla Estado Ticket creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_prioridad_ticket) === TRUE) {
    echo "Tabla Prioridad Ticket creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_categoria_ticket) === TRUE) {
    echo "Tabla Categoria Ticket creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_cliente) === TRUE) {
    echo "Tabla Cliente creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_ticket) === TRUE) {
    echo "Tabla Ticket creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_comentario_ticket) === TRUE) {
    echo "Tabla Comentario Ticket creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_archivo_adjunto) === TRUE) {
    echo "Tabla Archivo Adjunto creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_referer) === TRUE) {
    echo "Tabla Referer creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_usuario) === TRUE) {
    echo "Tabla Usuario creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_estado_correo) === TRUE) {
    echo "Tabla Estado Correo creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

if ($conn->query($sql_tb_frm_contacto) === TRUE) {
    echo "Tabla Formulario de Contacto creada exitosamente\n";
} else {
    echo "Error al crear la tabla: " . $conn->error . "\n";
}

$user = $config['USER_EMAIL'];
$pass = $config['USER_PASS'];

//insertar contraseña encriptada con bycrypt
$password = password_hash($pass, PASSWORD_DEFAULT);



//como comparo la contraseña encriptada
//password_verify($pass, $password);


/*
$sql_insert_usuario = "INSERT INTO tb_usuario (email, password) VALUES
('$user', '$password')";

if ($conn->query($sql_insert_usuario) === TRUE) {
    echo "Datos insertados en la tabla Usuario\n";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error . "\n";
}
/*
//insertar datos en la tabla tb_estado_correo
$sql_insert_estado_correo = "INSERT INTO tb_estado_correo (id, descripcion, estado) VALUES
('SENT', 'Enviado', 1),
('NOSEN', 'No enviado', 1),
('READ', 'Leido', 1)";

if ($conn->query($sql_insert_estado_correo) === TRUE) {
    echo "Datos insertados en la tabla Estado Correo";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error;
}
*/

//insetar 1 datos en ticket, estado, prioridad, categoria, comentario, archivo adjunto
/*$sql_insert_estado_ticket = "INSERT INTO tb_ticket_estado (descripcion, estado) VALUES
('Abierto', 1),
('Cerrado', 1),
('En Proceso', 1),
('Pendiente', 1)";

if ($conn->query($sql_insert_estado_ticket) === TRUE) {
    echo "Datos insertados en la tabla Estado Ticket\n";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error . "\n";
}

$sql_insert_prioridad_ticket = "INSERT INTO tb_ticket_prioridad (descripcion, estado) VALUES
('Alta', 1),
('Baja', 1),
('Media', 1)";

if ($conn->query($sql_insert_prioridad_ticket) === TRUE) {
    echo "Datos insertados en la tabla Prioridad Ticket\n";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error . "\n";
}

$sql_insert_categoria_ticket = "INSERT INTO tb_ticket_categoria (descripcion, estado) VALUES
('Soporte', 1),
('Ventas', 1),
('Reclamos', 1)";

if ($conn->query($sql_insert_categoria_ticket) === TRUE) {
    echo "Datos insertados en la tabla Categoria Ticket\n";
} else {
    echo "Error al insertar datos en la tabla: " . $conn->error . "\n";
}
*/


$conn->close();
?>
