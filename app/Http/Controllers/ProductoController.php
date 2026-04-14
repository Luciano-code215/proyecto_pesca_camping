<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request) 
    {
        // 1. Aquí capturamos la "nota" que viene en la URL (ej: ?categoria=pesca)
        $cat = $request->query('categoria');
        $tipo = $request->query('tipo');

        // 2. Definimos los productos estáticos
        $todos = [
            ["id" => 1, "nombre" => "Caña Caster", "descripcion" => "Caña Telesopica Caster Pacific 4.20m.<h6 class= text-start><ul><li>Fabricada en fibra de vidrio y grafito.</li><li>Peso: 535g</li><li>Para uso con reel frontal.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "caña", 'img' => 'caña-caster.png', "precio" => 44650],
            ["id" => 2, "nombre" => "Caña Solara", "descripcion" => "Caña Marine Sport Solara 2.70m 2 tramos.<h6 class= text-start><ul><li>Diseñada para uso con reel frontal.</li><li>Peso: 135g</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "caña", 'img' => 'caña-solara.png', "precio" => 65670],
            ["id" => 3, "nombre" => "Caña Spinit", "descripcion" => "caña Spinit Baitcast 1.98m 2 tramos.<h6 class= text-start><ul><li>Diseñada para uso con reel rotativo perfil bajo</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "caña", 'img' => 'caña-spinit.png', "precio" => 67850],
            ["id" => 4, "nombre" => "Caña Water Dog", "descripcion" => "Caña Water Dog East 2.40m 2 tramos.<h6 class= text-start><ul><li>Diseñada para uso con reel frontal.</li><li>Pesca variada</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "caña", 'img' => 'cañaWDeast.png', "precio" => 30000],
        ];

        $productosFiltrados = [];

       foreach ($todos as $producto) {
        // ¿Coincide la categoría? (O es nula si no se filtró)
        $coincideCat = ($cat == null) || ($cat == $producto['categoria']);
        
        // ¿Coincide el tipo? (O es nulo si no se filtró)
        $coincideTipo = ($tipo == null) || ($tipo == $producto['tipo']);

        // Si ambos coinciden, lo agregamos a la caja
        if ($coincideCat && $coincideTipo) {
            $productosFiltrados[] = $producto;
        }
    }

    return view('productos', ['productos' => $productosFiltrados]);
    }
}
