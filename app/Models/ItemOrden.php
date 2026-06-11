<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItemOrden extends Model
{
    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    protected static function booted()
    {
        static::saving(function ($item) {
            $item->subtotal = $item->cantidad * $item->precio_unitario;
        });

        static::saved(function ($item) {
            if ($item->orden) {
                $item->orden->actualizarTotal();
            }
        });

        static::deleted(function ($item) {
            if ($item->orden) {
                $item->orden->actualizarTotal();
            }
        });
    }

    public static function obtenerTopVendidos($limite = 3)
    {
        return self::select(
            'producto_id',
            DB::raw('SUM(cantidad) as total_vendido'),
            DB::raw('SUM(subtotal) as total_recaudado')
        )
            ->whereHas('orden', function ($query) {
                $query->where('estado', 'entregada');
            })
            ->groupBy('producto_id')
            ->orderBy('total_vendido', 'desc')
            ->with(['producto.categoria'])
            ->take($limite)
            ->get();
    }
}
