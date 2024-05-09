<?php

use App\Http\Controllers\CanalesImportantesController;
use App\Http\Controllers\ComandoPersonalizadoController;
use App\Http\Controllers\MensajesDelSistemaController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Route::controller(TicketsController::class)
    ->prefix('tickets')
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::controller(MensajesDelSistemaController::class)
    ->prefix('mensajes_del_sistema')
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::controller(CanalesImportantesController::class)
    ->prefix('canales_importantes')
    ->group(function () {
        Route::get('/', 'listar');
        Route::put('/', 'actualizar');
    });

Route::controller(ComandoPersonalizadoController::class)
    ->prefix('comandos_personalizados')
    ->group(function () {
        Route::get('/', 'listar');
        Route::get('/{palabra_clave}', 'obtener');
        Route::put('/', 'insertar');
    });
