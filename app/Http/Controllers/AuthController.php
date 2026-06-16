<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $datosValidados['rol'] = 'comprador';
        $datosValidados['active'] = true;

        User::registrarUser($datosValidados);

        return redirect()->back()->with('success', 'Usuario creado exitosamente');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $remember = $request->filled('remember');

        $usuario = User::where('email', $credenciales['email'])->first();

        if (!$usuario) {
            return back()->with('email_incorrecto', 'El correo electrónico no se encuentra registrado.');
        }

        if (!$usuario->active) {
            return back()->with('cuenta_desactivada', 'Tu cuenta se encuentra desactivada. Contacta al administrador.');
        }

        if (!Hash::check($credenciales['password'], $usuario->password)) {
            return back()->with('password_incorrecta', 'La contraseña introducida es incorrecta.');
        }

        Auth::login($usuario, $remember);

        $request->session()->regenerate();

        return back()->with('success', 'Inicio de sesión exitoso');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Has cerrado sesión exitosamente');
    }
}
