<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'asunto',
        'mensaje',
        'estado',
        'respuesta',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    public static function registrarContacto(array $datos)
    {
        $contacto = new self();
        $contacto->nombre = $datos['nombre'];
        $contacto->email = $datos['email'];
        $contacto->asunto = $datos['asunto'];
        $contacto->mensaje = $datos['mensaje'];
        $contacto->estado = 'pendiente';
        $contacto->respuesta = null;

        return $contacto->save();
    }

    public static function index(Request $request)
    {
        $query = self::orderBy('id', 'desc');

        if ($request->has('buscar') && !empty($request->get('buscar'))) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->get('buscar') . '%')
                  ->orWhere('email', 'like', '%' . $request->get('buscar') . '%')
                  ->orWhere('asunto', 'like', '%' . $request->get('buscar') . '%');
            });
        }

        return $query->get();
    }

    public function marcarComoRespondida()
    {
        $this->estado = 'respondida';
        return $this->save();
    }

    public static function obtenerContactosPendientes()
    {
        return self::where('estado', 'pendiente')->get();
    }

    public static function obtenerContactosRespondidos()
    {
        return self::where('estado', 'respondida')->get();
    }

}
