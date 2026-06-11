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

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }


    public function items()
    {
        return $this->hasManyThrough(ItemOrden::class, Producto::class, 'categoria_id', 'producto_id');
    }


    public static function obtenerTopVendidas($limite = 3)
    {
        $filtroSoloEntregadas = function ($query) {
            $query->whereHas('orden', function ($q) {
                $q->where('estado', 'entregada');
            });
        };

        return self::withSum(['items as total_vendido' => $filtroSoloEntregadas], 'cantidad')
            ->withSum(['items as total_recaudado' => $filtroSoloEntregadas], 'subtotal')
            ->orderBy('total_vendido', 'desc')
            ->take($limite)
            ->get();
    }
}
