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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function index()
    {
        return self::with('user')->orderBy('created_at', 'desc')->get();
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
}
