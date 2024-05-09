<?php

use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Route::controller(TicketsController::class)->prefix('tickets')->group(function () {
    Route::get('/', 'listar');
    Route::put('/', 'insertar');
});
