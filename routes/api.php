<?php

use App\Http\Controllers\TransporteController;
use App\Http\Controllers\HospedajeController;

//transportes
Route::get('/transportes', [TransporteController::class, 'apiIndex']);
Route::get('/transportes/{id}', [TransporteController::class, 'apiShow']);
Route::get('/transportes/tipo/{tipo}', [TransporteController::class, 'apiByType']);
Route::get('/transportes/buscar/capacidad', [TransporteController::class, 'apiByCapacity']);

// hospedajes
Route::get('/hospedajes', [HospedajeController::class, 'apiHospedajes']);
Route::get('/hospedajes', [HospedajeController::class, 'apiByDestino']);