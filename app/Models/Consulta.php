<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'user_id',
        'asunto',
        'mensaje',
        'estado',
    ];

    protected $casts = [
        'estado' => 'string',
    ];

    public static function registrarConsulta(array $datos)
    {
        $consulta = new Consulta();
        $consulta->user_id = auth()->id();
        $consulta->asunto = $datos['asunto'];
        $consulta->mensaje = $datos['mensaje'];
        $consulta->estado = 'pendiente';

        return $consulta->save();
    }
}
