<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FormConsultasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Models\Producto;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('inicio');
});

Route::get('/contacto', function () {
    return view('contacto');
});

Route::get('/crear_cuenta', function () {
    return view('crear_cuenta');
});

Route::post('/crear_cuenta', [AuthController::class, 'store']);

Route::get('/ingresar', function () {
    return view('ingresar');
});

Route::post('/ingresar', [AuthController::class, 'login']);

Route::get('/pesca', function () {
    return view('pesca');
});

Route::get('/camping', function () {
    return view('camping');
});

Route::get('/comercializacion', function () {
    return view('comercializacion');
});


Route::get('/quienes_somos', function () {
    return view('quienes_somos');
});

Route::get('/terminos_y_usos', function () {
    return view('terminos_y_usos');
});


Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

Route::get('/en_construccion', function () {
    return view('en_construccion');
});

Route::get('/form-consultas', function () {
    return view('form-consultas');
});

Route::post('/form-consultas', [FormConsultasController::class, 'enviarConsulta'])->name('enviar_consulta');

Route::get('/agregar_producto', function () {
    return view('agregar_producto');
});

Route::post('/agregar_producto', [ProductoController::class, 'store'])->name('agregar_producto');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
