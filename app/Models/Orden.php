<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'estado',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];
}
