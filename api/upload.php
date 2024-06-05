<?php

// Incluir el autoload.php de Composer
require __DIR__ . '/../vendor/autoload.php';

// Incluir el archivo de la clase CloudinaryService
require __DIR__ . '/CloudinaryService.php';

use App\Services\CloudinaryService;
use GuzzleHttp\Client;

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
        echo "El archivo se subió correctamente. URL: " . $uploadResult['secure_url'];
    } else {
        echo "Hubo un error al subir el archivo.";
    }

    // Realizar una solicitud HTTP a otra API utilizando Guzzle (ejemplo)
    try {
        // Crear una instancia de cliente Guzzle con la opción 'verify' establecida en 'false'
        $client = new Client(['verify' => false]);

        // URL de la API a la que deseas realizar la solicitud
        $url = 'https://api.example.com';

        // Realizar una solicitud GET a la URL especificada
        $response = $client->request('GET', $url);

        // Obtener el código de estado de la respuesta
        $statusCode = $response->getStatusCode();

        // Verificar si la solicitud fue exitosa (código de estado 200)
        if ($statusCode == 200) {
            // Obtener el cuerpo de la respuesta como una cadena JSON
            $body = $response->getBody()->getContents();

            // Procesar el cuerpo de la respuesta...
            echo "Respuesta de la API externa: " . $body;
        } else {
            echo "La solicitud a la API externa no fue exitosa. Código de estado: $statusCode";
        }
    } catch (Exception $e) {
        // Manejar la excepción si ocurre un error
        echo "Error al realizar la solicitud a la API externa: " . $e->getMessage();
    }
} else {
    echo "No se recibió ningún archivo para subir.";
}
?>
