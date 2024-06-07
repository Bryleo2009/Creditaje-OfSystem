<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    //quieo pasarle la carpeta y el nombre del archivo que puede ser imagen o documento 
    public function upload(Request $request)
    {   

        $file = $request->file('archivo');
        dd($request->file('archivo'));
        $file_path = $file->getPathname();

        $cloudinary = Cloudinary::upload($file_path, [
            'folder' => 'uploads',
            'resource_type' => 'auto'
        ]);

        return response()->json([
            'nombre' => $cloudinary->getPublicId(),
            'ruta' => $cloudinary->secure_url
        ]);
    }

}
