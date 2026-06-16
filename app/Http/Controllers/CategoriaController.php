<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('admin.categorias', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->activo = true;
        $categoria->save();

        return redirect()->route('categorias.index')->with('categoria_creada', '¡Categoría creada con éxito!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return redirect()->route('categorias.index')->with('categoria_creada', '¡Categoría modificada con éxito!');
    }

    public function desactivar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->activo = false; // Baja lógica
        $categoria->save();

        return redirect()->route('categorias.index')->with('categoria_desactivada', 'La categoría se ha ocultado.');
    }

    public function reactivar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->activo = true;
        $categoria->save();

        return redirect()->route('categorias.index')->with('categoria_reactivada', '¡La categoría vuelve a estar visible!');
    }


}