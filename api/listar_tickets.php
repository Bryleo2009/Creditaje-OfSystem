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


if (isset($_GET['rpktc'])) {
    $id = $_GET['rpktc'];
    //tiene la forma id + 'CTL' separa el id
    $id = explode('CTL', $id)[0];
    if(is_numeric($id)){
        $sql = "SELECT 
        tt.id, tt.asunto, tt.descripcion, tt.fecha_registro,
        tc.id as cliente_id, tc.nombre as cliente_nombre,
        ttp.descripcion as prioridad,
        ttc.descripcion as categoria,
        tte.descripcion as estado,
        archivos.archivos,
        comentarios.comentarios
    FROM tb_ticket tt
    INNER JOIN tb_cliente tc ON tc.id = tt.cliente_id AND tc.estado = 1
    INNER JOIN tb_ticket_prioridad ttp ON ttp.id = tt.prioridad AND ttp.estado = 1
    INNER JOIN tb_ticket_categoria ttc ON ttc.id = tt.categoria AND ttc.estado = 1
    INNER JOIN tb_ticket_estado tte ON tte.id = tt.estado AND tte.estado = 1
    LEFT JOIN (
        SELECT ticket_id, COALESCE(JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', arc.id,
                'nombre', arc.nombre,
                'ruta', arc.ruta 
            )
        ), '[]') AS archivos
        FROM tb_ticket_archivo_adjunto arc
        WHERE estado = 1
        GROUP BY ticket_id
    ) archivos ON archivos.ticket_id = tt.id
    LEFT JOIN (
        SELECT ticket_id, COALESCE(JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', coment.id,
                'texto', coment.comentario ,
                'fecha', coment.fecha_registro ,
                'cliente', coment.cliente_id
            )
        ), '[]') AS comentarios
        FROM tb_ticket_comentario coment
        WHERE estado = 1
        GROUP BY ticket_id
    ) comentarios ON comentarios.ticket_id = tt.id
    where tc.id = $id
    GROUP BY tt.id;";
    }
}else {
    $sql = "SELECT true";
}

$result = $conn->query($sql);

if ($result) {
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $archivos = $data[0]['archivos'];
    $archivos = json_decode($archivos);
    $comentarios = $data[0]['comentarios'];
    //comentarios es un arr conveirtelo a json
    $comentarios = json_decode($comentarios);
    echo json_encode(["status" => "success", "data" => $archivos]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al obtener los datos: " . $conn->error]);
    http_response_code(500);
}

$conn->close();
?>