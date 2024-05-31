<?php
function load_translation($language) {
    $file = __DIR__ . "/{$language}.php";
    if (file_exists($file)) {
        return include($file);
    } else {
        // Si el archivo de traducción no existe, cargar un archivo predeterminado (por ejemplo, inglés)
        return include(__DIR__ . "/en.php");
    }
}
