<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FormConsultasController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ConsultaController;
use App\Models\Consulta;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\Respuesta_consulta;
use App\Models\Orden;
use App\Models\ItemOrden;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CartController;


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


Route::get('/productosPub', [ProductoController::class, 'indexPub'])->name('productosPub');

Route::get('/en_construccion', function () {
    return view('en_construccion');
});

Route::get('contacto/form-contacto', function () {
    return view('contacto_cliente');
})->name('form.contacto');


// CARRITO:





///////////////////////////////////////////////////////////////////////////////








///// CLIENTES LOGUEADOS //////
Route::middleware('auth')->group(function () {

    Route::get('consultas/form-consultas', function () {
        return view('consulta_cliente');
    })->name('form.consultas');


    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');

    Route::get('/mis-consultas', function (Request $request) {
        $consultas = Consulta::buscarPorUsuarioId(auth()->id());
        if ($request->has('estado') && $request->estado !== 'todos') {
            $valorEstado = ($request->estado === 'pendientes') ? 'pendiente' : 'respondida';
            $consultas = $consultas->filter(function ($consulta) use ($valorEstado) {
                return $consulta->estado === $valorEstado;
            });
        }

        Respuesta_consulta::marcarComoLeidasPorConsultas($consultas);

        return view('mis-consultas', compact('consultas'));
    })->name('mis.consultas');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    ///////////////////////////   Ultima modificacion   //////////////////////////////
    Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');

    Route::post('/carrito/agregar/{id}', [CartController::class, 'add'])->name('cart.add');

    Route::get('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

    Route::patch('/carrito/update/{id}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/carrito/finalizar', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::post('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/mis-compras', function () {
        $ordenes = Orden::obtenerDeUsuarioLogueado();
        return view('mis_compras', compact('ordenes'));
    })->name('mis-compras');

});



////// PUBLICAS  //////    

Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');


////// ADMIN //////

Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $topProductos = ItemOrden::obtenerTopVendidos(3);
        $topCategorias = \App\Models\Categoria::obtenerTopVendidas(3);
        return view('admin.dashboard', compact('topProductos', 'topCategorias'));
    });

    Route::post('/admin/productos/store', [ProductoController::class, 'store'])->name('productos.store');

    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('productos.index');

    Route::get('/admin/contactos', function () {
        $contactos = Contacto::index(Request());
        return view('admin.contactos', compact('contactos'));
    })->name('admin.contactos');

    Route::get('/admin/categorias', function () {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    });

    Route::get('admin/pedidos', function (Request $request) {

        $ordenes = Orden::index($request);

        return view('admin.pedidos', compact('ordenes'));
    })->name('admin.pedidos');

    Route::get('/admin/consultas', function (Request $request) {
        $consultas = Consulta::index($request);
        return view('admin.consultas', compact('consultas'));
    })->name('admin.consultas');

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

    Route::post('/admin/contactos/{id}/leido', [ContactoController::class, 'marcarLeido'])->name('admin.contactos.leido');

    Route::post('/admin/consultas/atender', [ConsultaController::class, 'responder'])->name('admin.consultas.responder');

    Route::post('/admin/ordenes/{id}/actualizar-estado', function (Request $request, $id) {

        // Validamos que el estado enviado esté dentro de los permitidos
        $estadosValidos = array_keys(Orden::obtenerEstadosDisponibles());

        if (!in_array($request->estado, $estadosValidos)) {
            return response()->json(['success' => false, 'message' => 'Estado inválido'], 400);
        }

        // Buscamos la orden y la actualizamos directamente
        $orden = Orden::findOrFail($id);
        $orden->estado = $request->estado;
        $orden->save();

        // Respondemos con éxito a JavaScript
        return response()->json(['success' => true]);
    })->name('admin.ordenes.actualizar_estado');

});