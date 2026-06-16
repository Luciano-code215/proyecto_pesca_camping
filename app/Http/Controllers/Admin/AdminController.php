<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orden;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $datosValidados['rol'] = 'admin';
        $datosValidados['active'] = true;

        User::registrarUser($datosValidados);

        return redirect()->back()->with('registrado', 'Administrador creado exitosamente');
    }

    public function usuarios()
    {
        $usuarios = User::obtenerUsuarios();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function bajaAdmin($id)
    {
        try {
            $usuario = User::buscarPorId($id);
            $usuario->rol = 'comprador';
            $usuario->save();

            return redirect()->back()->with('admin_bajado', "Se ha revocado el acceso administrativo a {$usuario->name}.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error_baja_admin', 'No se pudo procesar la baja del administrador.');
        }
    }

    public function alternarEstado($id)
    {
        try {
            $usuario = User::buscarPorId($id);

            $usuario->active = !$usuario->active;
            $usuario->save();

            $mensaje = $usuario->active
                ? "Se ha reactivado el usuario {$usuario->name}."
                : "Se ha suspendido el usuario {$usuario->name}.";

            return redirect()->back()->with('activo_usuario_alternado', $mensaje);

        } catch (\Exception $e) {
            return redirect()->back()->with('no_se_pudo_alternar_activo', 'No se pudo alternar el estado del usuario.');
        }
    }

    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $idUsuarioLogueado = auth()->id();
            User::actualizarPassword($idUsuarioLogueado, $request->password);

            return redirect()->back()->with('contraseña_actualizada', 'Tu contraseña ha sido actualizada con éxito.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error_cambiar_password', 'No se pudo actualizar la contraseña.');
        }
    }

    public function actualizarEstadoOrden(Request $request, $id)
    {
        $estadosValidos = array_keys(Orden::obtenerEstadosDisponibles());

        if (!in_array($request->estado, $estadosValidos)) {
            return response()->json(['success' => false, 'message' => 'Estado inválido'], 400);
        }

        $orden = Orden::findOrFail($id);

        if ($request->estado === 'cancelada' && $orden->estado !== 'cancelada') {
            foreach ($orden->items as $item) {
                if ($item->producto) {
                    $item->producto->increment('stock', $item->cantidad);
                }
            }
        }

        $orden->estado = $request->estado;
        $orden->save();

        return response()->json(['success' => true]);
    }
}
