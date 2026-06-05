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

        return $contacto->save();
    }
}
