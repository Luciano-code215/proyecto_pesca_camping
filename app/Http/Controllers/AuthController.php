<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
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

        if (Auth::attempt(['email' => $credenciales['email'], 'password' => $credenciales['password'], 'active' => true], $remember)) {

            $request->session()->regenerate();

            return back()->with('success', 'Inicio de sesión exitoso');
        }

        return back()->with('error', 'Por favor verifica tus credenciales e intenta nuevamente');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Has cerrado sesión exitosamente');
    }
}
