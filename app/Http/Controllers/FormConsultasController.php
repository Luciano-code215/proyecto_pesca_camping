<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormConsultasController extends Controller
{
    public function enviarConsulta(Request $request)
    {

        return redirect()->back()->with([
            'mensaje_exito' => 'Gracias!',
            'nombre_usuario' => $request->nombre,
            'email_usuario' => $request->email
        ]);
    }
}
