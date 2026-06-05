<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|max:255',
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|min:10|max:2000',
        ], [
            'nombre.required' => 'Por favor, decinos tu nombre.',
            'email.required' => 'El correo electrónico es necesario para poder responderte.',
            'email.email' => 'El correo ingresado no pertenece a un dominio válido o existente.',
            'mensaje.min' => 'El mensaje es demasiado corto (mínimo 10 caracteres).',
        ]);

        Contacto::registrarContacto($datosValidados);

        return redirect()->back()->with([
            'mensaje_exito' => true,
            'nombre_usuario' => $request->nombre,
            'email_usuario' => $request->email
        ]);
    }
}