<?php

use App\Http\Controllers\TransporteController;

Route::prefix('api')->group(function () {
    Route::get('/transportes', [TransporteController::class, 'apiIndex']);
    Route::get('/transportes/{id}', [TransporteController::class, 'apiShow']);
    Route::get('/transportes/tipo/{tipo}', [TransporteController::class, 'apiByType']);
    Route::get('/transportes/buscar/capacidad', [TransporteController::class, 'apiByCapacity']);
});