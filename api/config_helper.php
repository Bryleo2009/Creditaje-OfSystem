<?php
// Función para leer el archivo config.env
function parseEnvFile($filepath) {
    if (!file_exists($filepath)) {
        throw new Exception("El archivo de configuración no existe: $filepath");
    }

    $env = [];
    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        $env[$name] = $value;
    }

    return $env;
}
?>
