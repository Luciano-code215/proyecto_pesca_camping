<?php

namespace App\Models;

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
