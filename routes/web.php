<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Correo;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/creditos', function () {return view('pages.creditaje');});
Route::post('/api/frm_contacto', [Correo::class, 'enviarFrmContacto'])->name('correo.frm_contacto');
Route::post('/log', [LogController::class, 'store']);

//crud de contacto
Route::prefix('api')->group(function () {
    Route::controller(ContactoController::class)->group(function () {
        Route::post('/contacto', 'guardar');
        Route::get('/contacto', 'listar');
        Route::get('/contacto/{id}', 'listarId');
        Route::put('/contacto/{id}', 'actualizar');
        Route::delete('/contacto/{id}', 'eliminar');
    });
});

