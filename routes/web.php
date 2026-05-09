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
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        
        // Usuarios
        Route::resource('/usuarios', UsuarioController::class)->except(['show']);
        Route::post('/usuarios/importar', [UsuarioController::class, 'importarCSV'])->name('usuarios.importar');
        Route::get('/usuarios/exportar', [UsuarioController::class, 'exportarCSV'])->name('usuarios.exportar');
        
        // Destinos
        Route::resource('/destinos', DestinoController::class);
        
        // Hospedajes
        Route::resource('/hospedajes', HospedajeController::class);
        
        // Viajes (Admin)
        Route::get('/viajes', [ViajeController::class, 'indexAdmin'])->name('viajes.index');
    });
});

// Admin - Transportes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/transportes', TransporteController::class);
});