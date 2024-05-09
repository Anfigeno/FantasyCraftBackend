<?php

use App\Http\Controllers\MensajesDelSistemaController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Route::controller(TicketsController::class)
    ->prefix('tickets')
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'insertar');
    });

Route::controller(MensajesDelSistemaController::class)
    ->prefix('mensajes_del_sistema')
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });
