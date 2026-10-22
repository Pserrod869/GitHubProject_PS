<?php

use Illuminate\Support\Facades\Route;

Route::get('hola', function () {
    return view('welcome');
});

//Route::get('/', [NombreControlador::class, 'método']);//
//artisan

Route::get('primerMetodo', [PrimerasRutasController::class, 'primerMetodo']);