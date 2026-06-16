<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
            $path = $archivoImagen->store('productos', 'public');

            $datos['url_imagen'] = Storage::url($path);
        }

        return self::create($datos);
    }
    protected static function booted()
    {
        static::creating(function ($producto) {
            if (empty($producto->sku)) {
                do {
                    $prefijo = strtoupper(substr(Str::slug($producto->nombre), 0, 3));
                    $prefijo = $prefijo ? $prefijo . '-' : 'ART-';

                    $skuGenerado = $prefijo . strtoupper(Str::random(6));
                } while (static::where('sku', $skuGenerado)->exists());

                $producto->sku = $skuGenerado;
            } else {
                $producto->sku = strtoupper($producto->sku);
            }
        });
    }

    public function scopeDeCategoria($query, $categoriaId)
    {
        return $query->where('categoria_id', $categoriaId);
    }


    public static function eliminarProducto($id)
    {
        $producto = self::find($id);

        if ($producto) {
            $producto->activo = false;

            return $producto->save();
        }

        return false;
    }


    public function actualizarProducto(array $datos, $archivoImagen = null)
    {
        if ($archivoImagen) {
            if ($this->url_imagen) {
                $oldPath = str_replace('/storage/', '', $this->url_imagen);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $archivoImagen->store('productos', 'public');
            $datos['url_imagen'] = Storage::url($path);
        }

        return $this->update($datos);
    }

    public static function filtrar($buscar, $categoria_id, $estado, $orden = null)
    {
        $query = self::query()->withSum('itemOrden as total_vendido', 'cantidad');

        if ($estado === 'inactivos') {
            $query->where('activo', false);
        } elseif ($estado === 'todos') {
        } else {
            $query->where('activo', true);
        }

        if (!empty(trim($buscar))) {
            $termino = trim($buscar);
            $query->where(function ($q) use ($termino) {
                $q->where('nombre', 'LIKE', "%{$termino}%")
                    ->orWhere('sku', 'LIKE', "%{$termino}%");
            });
        }

        if (!empty($categoria_id)) {
            $query->where('categoria_id', $categoria_id);
        }

        switch ($orden) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'stock':
                $query->orderBy('stock', 'asc');
                break;
            case 'alfabetico':
                $query->orderBy('nombre', 'asc');
                break;
            case 'mas_vendidos':
                $query->orderBy('total_vendido', 'desc');
                break;

            case 'menos_vendidos':
                $query->orderBy('total_vendido', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return $query->get();
    }

    public static function reactivarProducto($id)
    {
        $producto = self::find($id);
        if ($producto) {
            $producto->activo = true;
            return $producto->save();
        }
        return false;
    }

    public static function contarPorCategoria($categoriaId)
    {
        return self::where('categoria_id', $categoriaId)
            ->where('activo', true)
            ->count();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function descontarStock($cantidad)
    {
        if ($this->stock >= $cantidad) {
            $this->stock -= $cantidad;
            return $this->save();
        }
        return false;
    }

    public function itemOrden()
    {
        return $this->hasMany(\App\Models\ItemOrden::class, 'producto_id');
    }

    public static function conTotalVendido($query)
    {
        return $query->withSum('itemOrden as total_vendido', 'cantidad');
    }

}


