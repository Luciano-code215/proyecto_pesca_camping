<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{



    public function indexPub(Request $request)
    {
        $catId = $request->query('categoria');
        $tipo = $request->query('tipo');

        // A. Traemos TODAS las categorías activas de la BD para armar el menú dinámico
        $categoriasMenu = Categoria::where('activo', true)->get();

        // B. Iniciamos la consulta de productos
        $query = Producto::where('activo', true);

        if ($catId) {
            $query->where('categoria_id', $catId);
        }

        if ($tipo) {
            $query->where(function ($q) use ($tipo) {
                $q->where('nombre', 'LIKE', '%' . $tipo . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $tipo . '%');
            });
        }

        $productosFiltrados = $query->get();

        // C. Lógica de los Breadcrumbs dinámicos basados en BD
        $breadcrumbs = [];
        if ($catId) {
            $categoriaActual = Categoria::find($catId);
            $nombreCategoria = $categoriaActual ? $categoriaActual->nombre : 'Categoría';

            $breadcrumbs[] = [
                'label' => ucfirst($nombreCategoria),
                'url' => '/productosPub?categoria=' . $catId
            ];
        }

        if ($tipo) {
            $breadcrumbs[] = [
                'label' => ucfirst($tipo),
                'url' => '/productosPub?categoria=' . $catId . '&tipo=' . $tipo
            ];
        }

        // D. Enviamos tanto los productos como las categorías a la vista
        return view('productosPub', [
            'productos' => $productosFiltrados,
            'categoriasMenu' => $categoriasMenu, // <-- Enviamos la colección de categorías
            'breadcrumbs' => $breadcrumbs
        ]);
    }




    public function index(Request $request)
    {
        $categorias = Categoria::categoriasActivas();

        $estado = $request->get('estado', 'activos');

        // Mandamos los tres parámetros a tu método del modelo
        $productos = Producto::filtrar($request->buscar, $request->categoria_id, $estado);

        return view('admin.productos', compact('productos', 'categorias'));
    }

    // Procesa la reactivación lógica
    public function restore($id)
    {
        Producto::reactivarProducto($id);
        return redirect()->back()->with('producto_reactivado', 'Producto reactivado con éxito');
    }
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|integer',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:productos,sku',
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'activo' => 'boolean',
        ]);

        Producto::crearProducto($datosValidados, $request->file('url_imagen'));
        return redirect()->back()->with('producto_creado', 'Producto creado exitosamente');
    }

    public function destroy($id)
    {
        Producto::eliminarProducto($id);

        return redirect()->back()->with('producto_eliminado', 'Producto desactivado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::find($id);

        $categorias = Categoria::categoriasActivas();

        return view('admin.agregar_producto', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:productos,sku,' . $id,
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $producto->actualizarProducto($datosValidados, $request->file('url_imagen'));

        return redirect()->route('productos.index')->with('producto_actualizado', '¡El producto se ha actualizado correctamente!');
    }

}