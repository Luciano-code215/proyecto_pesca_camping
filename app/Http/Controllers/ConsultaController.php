<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

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
            'celular' => 'required|string|max:20',
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
}
