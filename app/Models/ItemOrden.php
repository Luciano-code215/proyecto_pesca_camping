<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
