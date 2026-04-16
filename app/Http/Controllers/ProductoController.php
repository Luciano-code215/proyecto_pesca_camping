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
            ["id" => 5, "nombre" => "Reel Caster", "descripcion" => "Reel Caster Blade 4004 Frontal.<h6 class= text-start><ul><li>Pensado para pesca variada.</li><li>Peso: 350g</li><li>4 Rulemanes.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "reel", 'img' => 'reel-caster.png', "precio" => 40100],
            ["id" => 6, "nombre" => "Reel Water Dog", "descripcion" => "Reel Water Dog Frontal Acura 7001.<h6 class= text-start><ul><li>Pensado para pesca variada.</li><li>Peso: 260g</li><li>Rulemanes blindados.</li><li>Hasta 10Kg de arrastre</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "reel", 'img' => 'reel-waterdog.png', "precio" => 38300],
            ["id" => 7, "nombre" => "Reel Marine Sport", "descripcion" => "Reel Marine Sport Rotativo Ventura VT5.<h6 class= text-start><ul><li>Pensado para baitcasting.</li><li>Peso: 300g</li><li>Cuerpo de aluminio.</li><li>Hasta 4Kg de arrastre</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "reel", 'img' => 'reel-marinesport.png', "precio" => 67850],
            ["id" => 8, "nombre" => "Reel Sumax", "descripcion" => "Reel Sumax Rotativo.<h6 class= text-start><ul><li>Pensado para baitcasting.</li><li>Peso: 310g</li><li>Cuerpo de aluminio.</li><li>Hasta 7Kg de arrastre</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "reel", 'img' => 'reel-sumax.png', "precio" => 45000],
            ["id" => 9, "nombre" => "Reel Albatros", "descripcion" => "Reel Albatros Rotativo Aqua20.<h6 class= text-start><ul><li>Pensado para trolling.</li><li>Peso: 410g</li><li>Hasta 7Kg de arrastre</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "reel", 'img' => 'reel-albatros.png', "precio" => 171500],
            ["id" => 10, "nombre" => "Caja Matzuno", "descripcion" => "Caja Matzuno H0415.<h6 class= text-start><ul><li>3 bandejas desplegables.</li><li>Bandejas internas con separadores.</li><li>Tapa traslucida.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'caja-matzuno.png', "precio" => 39300],
            ["id" => 11, "nombre" => "Caja Caster", "descripcion" => "Caja de pesca Caster 30*17*14cm.<h6 class= text-start><ul><li>2 bandejas desplegables con 14 divisiones.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'caja-caster.png', "precio" => 39300],
            ["id" => 12, "nombre" => "Kit Esmerilloes y ", "descripcion" => "60 unidades surtidas.<h6 class= text-start><ul><li>20 Esmerillones n° 5</li><li>20 Esmerillones n°8</li><li>20 Mosquetones n°5</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'kit-mosquetones.png', "precio" => 8100],
            ["id" => 13, "nombre" => "Kit Anzuelos", "descripcion" => "50 unidades tamaños surtidos<h6 class= text-start><ul><li>Modelo pata larga</li><li>Desde el n°3 al n°8.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'kit-anzuelos.png', "precio" => 16700],
            ["id" => 14, "nombre" => "Kit Señuelos Banana", "descripcion" => "3 Señuelos para baitcasting<h6 class= text-start><ul><li>Ideal pesca de dorado.</li><li>Marca Don KB.</li><li>Peso: 28g.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'kit-señuelos-donkb.png', "precio" => 81200],
            ["id" => 15, "nombre" => "Señuelo BNV", "descripcion" => "Señuelo banana especifico para trolling<h6 class= text-start><ul><li>14 cm.</li><li>55g.</li><li>Pala 4.</li></ul></h6>", 'categoria' => 'pesca', "tipo" => "accesorio", 'img' => 'señuelo-trolling.png', "precio" => 20300],
            ["id" => 16, "nombre" => "Carpa para 2 personas", "descripcion" => "Carpa camuflada para 2 personas<h6 class= text-start><ul><li>Dimesiones: 210*150cm.</li><li>Tipo iglú, fabricada en poliéster.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'carpa-2p.png', "precio" => 43600],
            ["id" => 17, "nombre" => "Carpa para 3 personas", "descripcion" => "Carpa autoarmable para 3 personas<h6 class= text-start><ul><li>Dimesiones: 200*150*135cm.</li><li>Tipo iglú, fabricada en poliéster, incluye mosquitero.</li><li>Peso: 1.1Kg</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'carpa-3p.png', "precio" => 40700],
            ["id" => 18, "nombre" => "Carpa para 4 personas", "descripcion" => "Carpa autoarmable para 4 personas, premium<h6 class= text-start><ul><li>Dimesiones: 240*240*180cm.</li><li>Fabricada en poliéster, incluye mosquitero.</li><li>Peso: 8.2Kg, incluye bolso de transporte.</li><li>Protección contra rayos UV.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'carpa-4p.png', "precio" => 167200],
            ["id" => 19, "nombre" => "Tarp Free Wolf", "descripcion" => "Tarp Free Wolf impermeable.<h6 class= text-start><ul><li>Dimensiones: 300*300cm.</li><li>Peso: 800g</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'tarp.png', "precio" => 64100],
            ["id" => 20, "nombre" => "Gazebo 3x3", "descripcion" => "Gazebo plegable marca Fox<h6 class= text-start><ul><li>Tela oxford 1080D.</li><li>Protección UV.</li><li>Peso: 15Kg</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'gazebo.png', "precio" => 90900],
            ["id" => 21, "nombre" => "Gazebo 3x3", "descripcion" => "Gazebo plegable marca Gadnic con paredes<h6 class= text-start><ul><li>Tela oxford 1080D.</li><li>Protección UV.</li><li>Peso: 15Kg</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'gazebo-paredes.png', "precio" => 120900],
            ["id" => 22, "nombre" => "Silla plegable", "descripcion" => "Silla plegable Smart Tech<h6 class= text-start><ul><li>Reforzada, soporta hasta 130kg.</li><li>Comodidad asegurada.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'silla-grande.png', "precio" => 62700],
            ["id" => 23, "nombre" => "Silla plegable", "descripcion" => "Silla plegable director<h6 class= text-start><ul><li>Soporta hasta 100kg.</li><li>Equipada con pasa vasos.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'silla.png', "precio" => 20900],
            ["id" => 24, "nombre" => "Colchon Inflable 1 plaza", "descripcion" => "Colchon inflable 1 plaza marca Alpina<h6 class= text-start><ul><li>Soporta hasta 120kg.</li><li>Almohada alta para mayor comodidad.</li><li>Incluye inflador.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'colchon-1p.png', "precio" => 28300],
            ["id" => 25, "nombre" => "Colchon Inflable 2 plazas", "descripcion" => "Colchon inflable 2 plazas marca Alpina<h6 class= text-start><ul><li>Soporta hasta 240kg.</li><li>Almohada alta para mayor comodidad.</li><li>Incluye inflador.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'colchon-2p.png', "precio" => 43600],    
            ["id" => 26, "nombre" => "Termo de acero", "descripcion" => "Termo de acero inoxidable marca Lumilagro<h6 class= text-start><ul><li>Capacidad: 1 litro.</li><li>Conserva líquidos calientes por 12 horas y fríos por 24 horas.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'termo.png', "precio" => 57000],
            ["id" => 27, "nombre" => "Anafe portátil", "descripcion" => "Anafe portátil a gas marca Brogas<h6 class= text-start><ul><li>2 hornallas.</li><li>Incluye maletín de transporte.</li><li>Compatible con garrafas de 10kg.</li></ul></h6>", 'categoria' => 'camping', "tipo" => null, 'img' => 'anafe.png', "precio" => 48000],
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

    // 1. Inicializamos el array vacío
    $breadcrumbs = [];
    
    // 2. Si hay categoría, agregamos el primer paso
    if ($cat) {
        $breadcrumbs[] = [
            'label' => ucfirst($cat), 
            'url' => '/productos?categoria=' . $cat
        ];
    }
    
    // 3. Si hay tipo, agregamos el segundo paso AL MISMO ARRAY
    // IMPORTANTE: Aquí no usamos '=', sino que el array ya contiene lo anterior
    if ($tipo) {
        $breadcrumbs[] = [
            'label' => ucfirst($tipo), 
            'url' => '/productos?categoria=' . $cat . '&tipo=' . $tipo
        ];
    }

    return view('productos', [
        'productos' => $productosFiltrados,
        'breadcrumbs' => $breadcrumbs 
    ]);
    }
}
