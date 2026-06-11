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

    public static function tieneRespuestasPendientes()
    {
        if (!auth()->check()) {
            return false;
        }

        return self::where('leido', false)
            ->whereHas('consulta', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->exists();
    }

    public static function marcarComoLeidasPorConsultas($consultas)
    {
        // 1. Validamos que la colección no esté vacía para evitar queries innecesarias
        if (!$consultas || $consultas->isEmpty()) {
            return 0;
        }

        // 2. Extraemos todos los IDs de las consultas recibidas
        $consultaIds = $consultas->pluck('id');

        // 3. Buscamos las respuestas de esas consultas que estén sin leer y las actualizamos
        return self::whereIn('consulta_id', $consultaIds)
            ->where('leido', false) // Cambiá 'leido' por tu columna real (ej: 'visto')
            ->update(['leido' => true]);
    }
}
