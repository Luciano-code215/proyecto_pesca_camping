<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'estado',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public static function index($request)
    {
        $query = self::with(['user', 'items'])->orderBy('created_at', 'desc');

        if ($request->has('estado') && $request->estado !== 'todos') {
            if (in_array($request->estado, ['creada', 'pendientePago'])) {
                $query->whereIn('estado', ['creada', 'pendientePago']);
            } else {
                $query->where('estado', $request->estado);
            }
        }

        return $query->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con los renglones (ítems)
    public function items()
    {
        return $this->hasMany(ItemOrden::class, 'orden_id');
    }

    /**
     * 🟢 Retorna el ID formateado con hash y ceros a la izquierda (Ej: #0003)
     */
    public function obtenerCodigoFormateado()
    {
        return '#' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    /**
     * 🟢 Retorna la fecha de creación formateada en estilo Latinoamericano
     */
    public function obtenerFechaFormateada()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * 🟢 Calcula el total dinámicamente sumando los subtotales de sus ítems
     * y lo devuelve formateado como moneda con signo pesos.
     */
    public function obtenerTotalMoneda()
    {
        // Usamos la relación 'items' cargada en memoria y sumamos la columna subtotal
        $totalCalculado = $this->items->sum('subtotal');
        return '$' . number_format($totalCalculado, 0, ',', '.');
    }


    /**
     * 🟢 Retorna el HTML del Badge de envío con sus respectivos iconos de Bootstrap
     */
    public function obtenerBadgeEnvio()
    {
        switch ($this->estado) {
            case 'creada':
            case 'pendientePago':
                return '<span class="badge bg-secondary"><i class="bi bi-hourglass me-1"></i> Esperando Pago</span>';
            case 'pagada':
                return '<span class="badge bg-info text-dark"><i class="bi bi-box-seam me-1"></i> Pagada</span>';
            case 'pendienteEnvio':
                return '<span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> Pendiente Envío</span>';
            case 'entregada':
                return '<span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Entregada</span>';
            case 'cancelada':
                return '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Cancelada</span>';
            default:
                return '<span class="badge bg-light text-dark border">' . $this->estado . '</span>';
        }
    }

    public static function obtenerEstadosDisponibles()
    {
        return [
            'creada' => 'Esperando Pago',
            'pendienteEnvio' => 'Pendiente Envío',
            'entregada' => 'Entregada',
            'cancelada' => 'Cancelada',
            'pagada' => 'Pagada',
        ];
    }

    public static function obtenerPendientesEnvio()
    {
        return self::where('estado', 'pendienteEnvio')->get();
    }

    public static function obtenerEntregadas()
    {
        return self::where('estado', 'entregada')->get();
    }

    public function actualizarTotal()
    {
        $this->total = $this->items()->sum('subtotal');
        return $this->save();
    }

}
