<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $datosValidados['rol'] = 'admin';
        $datosValidados['active'] = true;

        User::registrarUser($datosValidados);

        return redirect()->back()->with('success', 'Administrador creado exitosamente');

    }

    public function usuarios()
    {
        // Llamamos a tu método del modelo (devuelve la colección de objetos)
        $usuarios = User::obtenerUsuarios();

        // Pasamos la variable '$usuarios' a la vista
        return view('admin.usuarios', compact('usuarios'));
    }
}
