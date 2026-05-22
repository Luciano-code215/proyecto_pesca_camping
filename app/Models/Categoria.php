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

}
