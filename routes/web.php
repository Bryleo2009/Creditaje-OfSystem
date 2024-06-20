<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Correo;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index']);

Route::get('/prueba', function () {
    $nombre = "Juan";
    $idCliente = 0;
    return view('email.cliente', ['nombre' => $nombre, 'idCliente' => $idCliente]);
});

Route::get('/moran_vega', function () {return view('pages.perfil');});
Route::get('/creditos', function () {return view('pages.creditaje');});
// Route::post('/api/frm_contacto', [Correo::class, 'enviarFrmContacto'])->name('correo.frm_contacto');
Route::post('/log', [LogController::class, 'store']);

//crud de contacto | ofsys -> id + CLT
Route::prefix('api')->group(function () {
    Route::controller(WebController::class)->group(function () {
        Route::get('/logo_correo', 'logoCorreo');
    });


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

    Route::post('/upload',[UploadController::class,'upload']);
});

// Rutas protegidas por autenticación en la sección "admin-back"
Route::prefix('admin-back')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/autenticar', 'autenticar');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });  

    // Rutas accesibles solo para usuarios autenticados
    Route::middleware('auth')->group(function () {
        Route::get('dash', 'DashController@index')->name('dash');

        Route::prefix('tck')->group(function () {
            Route::controller(TicketController::class)->group(function () {
                Route::get('/client/{ofsys}', 'listarCliente')->name('client_tickets');
                Route::get('/client/{ofsys}/{id}', 'frmTicket')->name('ticket.show');
                Route::put('/{id}', 'actualizar');
                Route::delete('/{id}', 'eliminar')->name('ticket.destroy');
                Route::post('/client/{ofsys}', 'guardar');
                Route::get('/new/{ofsys}','frmTicket')->name('new_ticket');
                Route::post('/coment/{ofsys}/{idTck}', 'guardarComentario');
                Route::get('/clientes','listar')->name('tickets');
            });
        });
    });
});

