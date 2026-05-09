<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\HospedajeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ViajeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransporteController;

// Páginas públicas
Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/destinos', [DestinoController::class, 'apiDestinos'])->name('destinos.publicos');

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'clientDashboard'])->name('dashboard');
    
    // Viajes (Cliente)
    Route::resource('/viajes', ViajeController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/viajes/{viaje}/pdf', [ViajeController::class, 'descargarPDF'])->name('viajes.pdf');
    
    // Admin
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // destinos
        Route::resource('/destinos', DestinoController::class);
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        
        // Usuarios
        Route::resource('/usuarios', UsuarioController::class)->except(['show']);
        Route::post('/usuarios/importar', [UsuarioController::class, 'importarCSV'])->name('usuarios.importar');
        Route::get('/usuarios/exportar', [UsuarioController::class, 'exportarCSV'])->name('usuarios.exportar');
        
        // Hospedajes
        Route::resource('/hospedajes', HospedajeController::class);
        
        // Viajes (Admin)
        Route::get('/viajes', [ViajeController::class, 'indexAdmin'])->name('viajes.index');
        Route::get('/viajes/create', [ViajeController::class, 'createAdmin'])->name('viajes.create');
        Route::post('/viajes', [ViajeController::class, 'storeAdmin'])->name('viajes.store');

        Route::get('/viajes/{viaje}', [ViajeController::class, 'show'])->name('viajes.show');

        Route::get('/viajes/{viaje}/edit', [ViajeController::class, 'edit'])->name('viajes.edit');
        Route::put('/viajes/{viaje}', [ViajeController::class, 'update'])->name('viajes.update');

        Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('viajes.destroy');

    });
});

// Admin - Transportes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/transportes', TransporteController::class);
});

Route::get('/destinos', [DestinoController::class, 'publicIndex'])->name('destinos.publicos');