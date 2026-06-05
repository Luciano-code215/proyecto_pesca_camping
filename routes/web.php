<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FormConsultasController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Http\Middleware\AdminMiddleware;


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
})->name('login');

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

Route::get('/form-contacto', function () {
    return view('contacto_cliente');
})->name('form.contacto');





Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


///// CLIENTES LOGUEADOS //////
Route::middleware('auth')->group(function () {
    Route::get('/form-consultas', function () {
        return view('consulta_cliente');
    })->name('form.consultas');


    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
});



////// PUBLICAS  //////    

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');


////// ADMIN //////

Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::post('/admin/productos/store', [ProductoController::class, 'store'])->name('productos.store');

    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');

    Route::get('/admin/contactos', function () {
        $contactos = Contacto::all();
        return view('admin.contactos', compact('contactos'));
    });

    Route::get('/admin/categorias', function () {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    });

    Route::get('admin/pedidos', function () {
        return view('admin.pedidos');
    });

    Route::get('/admin/consultas', function () {
        return view('admin.consultas');
    });

    Route::get('/admin/informes', function () {
        return view('admin.informes');
    });

    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin_usuarios');

    Route::post('/crear-admin', [AdminController::class, 'store'])->name('crear_admin');

    Route::post('/admin/usuarios/{id}/alternar-estado', [AdminController::class, 'alternarEstado'])->name('admin.usuarios.estado');

    Route::post('/admin/usuarios/{id}/baja-admin', [AdminController::class, 'bajaAdmin']);

    Route::post('/admin/usuarios/cambiar-password', [AdminController::class, 'cambiarPassword']);

    Route::get('/admin/agregar_producto', function () {
        $categorias = Categoria::categoriasActivas();
        return view('admin.agregar_producto', compact('categorias'));
    });

    Route::patch('/admin/productos/{id}/reactivar', [ProductoController::class, 'restore'])->name('productos.restore');

    Route::get('/admin/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');

    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

    Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('categorias.store');

    Route::patch('/admin/categorias/{id}/desactivar', [CategoriaController::class, 'desactivar'])->name('categorias.desactivar');

    Route::patch('/admin/categorias/{id}/reactivar', [CategoriaController::class, 'reactivar'])->name('categorias.reactivar');

    Route::put('/admin/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');

});