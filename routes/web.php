<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;


Route::get('/', function () {
    return view('inicio');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/crear_cuenta', function () {
    return view('crear_cuenta');
});

Route::get('/ingresar', function () {
    return view('ingresar');
});

Route::get('/pesca', function () {
    return view('pesca');
});

Route::get('/camping', function () {
    return view('camping');
});

Route::get('/quienes_somos', function () {
    return view('quienes_somos');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

