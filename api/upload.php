<?php

require __DIR__ . '/../vendor/autoload.php';
// Incluir el archivo de la clase CloudinaryService
require __DIR__ . '/CloudinaryService.php';

use App\Services\CloudinaryService;

// Verificar si se envió un archivo
if (isset($_FILES['file'])) {
    // Crear una instancia del servicio de Cloudinary
    $cloudinaryService = new CloudinaryService();

    // Ruta temporal del archivo cargado
    $tmpFilePath = $_FILES['file']['tmp_name'];

    // Subir el archivo a Cloudinary
    $uploadResult = $cloudinaryService->uploadImage($tmpFilePath, 'archivo_subido');

    // Mostrar la URL del archivo subido
    if ($uploadResult && isset($uploadResult['secure_url'])) {
        echo $uploadResult['secure_url'];
    } else {
        echo "Hubo un error al subir el archivo.";
    }
} else {
    echo "No se recibió ningún archivo para subir.";
}
?>
