<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Respuesta_consulta;
use App\Models\Orden;

class ConsultaController extends Controller
{
    public function create()
    {
        return view('admin.consultas.create');
    }

    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|min:10|max:2000',
        ], [
            'asunto.required' => 'El asunto es obligatorio.',
            'mensaje.min' => 'Por favor, detalla un poco más tu consulta (mínimo 10 caracteres).',
        ]);

        Consulta::registrarConsulta($datosValidados);

        return redirect()->back()->with([
            'mensaje_exito' => true,
            'nombre_usuario' => auth()->user()->name,
            'email_usuario' => auth()->user()->email
        ]);
    }

    public function misConsultas(Request $request)
    {
        $consultas = Consulta::buscarPorUsuarioId(auth()->id());

        if ($request->has('estado') && $request->estado !== 'todos') {
            $valorEstado = ($request->estado === 'pendientes') ? 'pendiente' : 'respondida';
            $consultas = $consultas->filter(function ($consulta) use ($valorEstado) {
                return $consulta->estado === $valorEstado;
            });
        }

        Respuesta_consulta::marcarComoLeidasPorConsultas($consultas);

        return view('mis-consultas', compact('consultas'));
    }

    public function misCompras()
    {
        $ordenes = Orden::obtenerDeUsuarioLogueado();
        return view('mis_compras', compact('ordenes'));
    }

    public function responder(Request $request)
    {
        $request->validate([
            'consulta_id' => 'required|exists:consultas,id',
            'respuesta' => 'required|string|min:5',
        ]);

        Respuesta_consulta::guardarRespuesta(
            $request->consulta_id,
            $request->respuesta
        );

        return redirect()
            ->back()
            ->with('respuesta_guardada', 'La respuesta se guardó correctamente y el cliente ha sido notificado.');
    }
}
