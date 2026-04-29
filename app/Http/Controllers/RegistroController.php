<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function registrar(Request $request) 
    {
        // Aquí podria agregar lógica para validar y guardar el nuevo usuario
        // Por ahora, simplemente redirigimos a una página de "en construcción"
        return redirect('/en_construccion');
    }
}
