<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'precio',
        'stock',
        'sku',
        'url_imagen',
        'activo',
    ];
    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
    ];

    public static function crearProducto(array $datos, $archivoImagen = null)
    {
        if ($archivoImagen) {
            $path = $archivoImagen->store('public/productos');
            $datos['url_imagen'] = Storage::url($path);
        }

        return self::create($datos);
    }
}


