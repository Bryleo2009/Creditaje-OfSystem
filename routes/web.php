<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Correo;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/moran_vega', function () {return view('pages.perfil');});
Route::get('/creditos', function () {return view('pages.creditaje');});
// Route::post('/api/frm_contacto', [Correo::class, 'enviarFrmContacto'])->name('correo.frm_contacto');
Route::post('/log', [LogController::class, 'store']);

//crud de contacto | ofsys -> id + CLT
Route::prefix('api')->group(function () {
    Route::controller(ContactoController::class)->group(function () {
        Route::post('/contacto', 'guardar');
        Route::get('/contacto', 'listar');
        Route::get('/contacto/{ofsys}', 'listarId');
        Route::put('/contacto/{ofsys}', 'actualizar'); // Corregido
        Route::delete('/contacto/{ofsys}', 'eliminar');
    });

    Route::controller(Correo::class)->group(function () {
        Route::post('/frm_contacto', 'enviarFrmContacto');
    });
});

