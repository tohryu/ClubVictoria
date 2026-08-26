<?php

use App\Http\Controllers\PromocionController;
use App\Http\Controllers\ReservaController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\MesaAdminController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Página Principal
Route::get('/', [PromocionController::class, 'publicIndex'])->name('home');

/*
|--------------------------------------------------------------------------
| FLUJO DE RESERVACIÓN (SOLO USUARIOS AUTENTICADOS)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/reservar-mesa', [ReservaController::class, 'mapa'])->name('reserva.mapa');
    Route::post('/procesar-reserva', [ReservaController::class, 'procesarReserva'])->name('reserva.procesar');
    Route::get('/mis-reservas', [ReservaController::class, 'misReservas'])->name('reservas.mis_reservas');
});

/*
|--------------------------------------------------------------------------
| PANEL DE ADMINISTRACIÓN (SOLO ADMINS)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/promociones')->name('admin.promociones.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [PromocionController::class, 'index'])->name('index');
    
    // Promociones
    Route::post('/', [PromocionController::class, 'store'])->name('store');
    Route::patch('/{id}/toggle', [PromocionController::class, 'toggleStatus'])->name('toggle');
    Route::delete('/{id}', [PromocionController::class, 'destroy'])->name('destroy');

    // Eventos
    Route::post('/eventos', [PromocionController::class, 'storeEvento'])->name('eventos.store');
    Route::patch('/eventos/{id}/toggle', [PromocionController::class, 'toggleStatusEvento'])->name('eventos.toggle');
    Route::delete('/eventos/{id}', [PromocionController::class, 'destroyEvento'])->name('eventos.destroy');
});

/*
|--------------------------------------------------------------------------
| PANEL DE ADMINISTRACIÓN - PRECIO DE MESAS (SOLO ADMINS)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/mesas')->name('admin.mesas.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [MesaAdminController::class, 'index'])->name('index');
    Route::patch('/{id}/precio', [MesaAdminController::class, 'updatePrecio'])->name('update_precio');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD Y EQUIPOS (AUTENTICADO)
|--------------------------------------------------------------------------
*/
Route::prefix('{current_team}')
    ->where(['current_team' => '[a-zA-Z0-9\-]+']) 
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });


// Autenticación con Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



require __DIR__.'/settings.php';