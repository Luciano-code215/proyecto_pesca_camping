<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Respuesta_consulta;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function index(Request $request)
    {
        $query = self::with('user')->orderBy('created_at', 'desc');

        if ($request->has('estado') && $request->estado !== 'todos') {
            $valorEstado = ($request->estado === 'pendientes') ? 'pendiente' : 'respondida';
            $query->where('estado', $valorEstado);
        }

        return $query->get();
    }

    public static function consultasPendientes()
    {
        return self::where('estado', 'pendiente')->get();
    }

    public static function consultasRespondidas()
    {
        return self::where('estado', 'respondida')->get();
    }

    public function marcarComoRespondida()
    {
        $this->estado = 'respondida';
        return $this->save();
    }

    public static function buscarPorId(int $id)
    {
        return self::find($id);
    }

    public static function buscarPorUsuarioId(int $userId)
    {
        return self::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function respuesta()
    {
        return $this->hasOne(Respuesta_consulta::class, 'consulta_id');
    }
}
