<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public static function buscar($id)
    {
        return self::find($id);
    }

    public function create()
    {
        // CAMBIA Categoria::all() POR ESTO:
        $categorias = $this->categoriasActivas();

        return view('admin.agregar_producto', compact('categorias'));
    }

    public function edit($id)
    {
        $producto = \App\Models\Producto::find($id);

        // ASÍ TAMBIÉN AQUÍ:
        $categorias = \App\Models\Categoria::where('activo', true)->get();

        return view('admin.agregar_producto', compact('producto', 'categorias'));
    }

    public static function categoriasActivas()
    {
        return self::where('activo', true)->get();
    }
}
