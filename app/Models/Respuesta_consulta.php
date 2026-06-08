<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta_consulta extends Model
{
    protected $table = 'respuesta_consultas';

    protected $fillable = ['consulta_id', 'respuesta', 'leido'];

    protected $casts = [
        'leido' => 'boolean',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id');
    }

    public static function guardarRespuesta(int $consultaId, string $textoRespuesta)
    {

        Consulta::buscarPorId($consultaId)->marcarComoRespondida();

        return self::create([
            'consulta_id' => $consultaId,
            'respuesta' => $textoRespuesta,
            'leido' => false,
        ]);
    }

    public static function buscarPorConsultaId(int $consultaId)
    {
        return self::where('consulta_id', $consultaId)->first();
    }
}
