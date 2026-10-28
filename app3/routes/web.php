<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/', [MainController::class, 'index']);

// Ruta para la página de botones
Route::get('/botones', function () {
    return view('buttons'); 
});

// Ruta para la página de tarjetas
Route::get('/tarjetas', function () {
    return view('cards'); 
});

Route::get('/colores', function () { return view('color'); });
Route::get('/bordes', function () { return view('borders'); });
Route::get('/animaciones', function () { return view('animation'); });
Route::get('/otros', function () { return view('other'); });


Route::get('/login', function () { return view('login'); });
Route::get('/register', function () { return view('register'); });
Route::get('/forgot-password', function () { return view('forgot-password'); });
Route::get('/charts', function () { return view('charts'); });
Route::get('/tables', function () { return view('tables'); });