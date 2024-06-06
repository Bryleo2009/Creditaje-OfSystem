<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Correo;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TicketController;
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

// Rutas protegidas por autenticación en la sección "admin-back"
Route::prefix('admin-back')->group(function () {
    // Ruta de inicio de sesión
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Ruta para procesar el inicio de sesión
    Route::post('login', 'Auth\LoginController@login');
    // Ruta para cerrar sesión
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Rutas accesibles solo para usuarios autenticados
    Route::middleware('auth')->group(function () {
        // Ruta del panel de control
        Route::get('dash', 'DashController@index')->name('dash');
    });
});

Route::prefix('tck')->group(function () {
    Route::controller(TicketController::class)->group(function () {
        // Route::get('/client', 'listar');
        Route::get('/client/{ofsys}', 'listarCliente')->name('client_tickets');
        Route::get('/client/{ofsys}/{id}', 'listarId');
        Route::put('/{id}', 'actualizar');
        Route::delete('/{id}', 'eliminar');
        Route::post('/client/{ofsys}', 'guardar');
        Route::get('/new/{ofsys}','frmTicket')->name('new_ticket');
    });
});