<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('carrito', compact('cart'));
    }

    public function add($id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        // Verificamos si ya hay stock suficiente para sumar 1 más
        $cantidadActual = isset($cart[$id]) ? $cart[$id]['cantidad'] : 0;
        
        if ($cantidadActual + 1 > $producto->stock) {
            return redirect()->back()->with('error', "Lo sentimos, solo quedan {$producto->stock} unidades disponibles de este producto.");
        }

        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            $cart[$id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->url_imagen // Corregido según tu migración real
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    // NUEVO MÉTODO: Actualiza cantidades sumando o restando y validando stock
    public function update(Request $request, $id)
{
    // FORZAMOS EL ID A ENTERO: Evita que "3" (texto) falle al compararse con 3 (número)
    $id = (int)$id;

    // 1. Buscamos el producto directo en la Base de Datos
    $producto = Producto::findOrFail($id);
    $cart = session()->get('cart', []);
    $accion = $request->input('action'); 

    // 2. Verificamos si el producto realmente existe en el carrito
    if (array_key_exists($id, $cart) || isset($cart[$id])) {
        
        if ($accion === 'increment') {
            
            // VALIDACIÓN ESTRICTA DE STOCK
            // Comparamos el valor actual en el carrito contra el stock real de la BD
            if ($cart[$id]['cantidad'] >= $producto->stock) {
                return redirect()->back()->with('error', "No podés sumar más unidades. El stock máximo disponible de {$producto->nombre} es de {$producto->stock} unidades.");
            }
            
            // Si pasa la validación, recién ahí incrementamos
            $cart[$id]['cantidad']++;

        } elseif ($accion === 'decrement') {
            $cart[$id]['cantidad']--;
            
            // Si la cantidad llega a 0, se elimina de la sesión
            if ($cart[$id]['cantidad'] <= 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Producto removido del carrito.');
            }
        }
        
        // Guardamos los cambios reales en la sesión del usuario
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cantidad actualizada correctamente.');
    }

    return redirect()->back()->with('error', 'El producto no se encontró en tu carrito.');
}

    public function remove($id)
    {
        // 1. Obtenemos el carrito de la sesión
        $cart = session()->get('cart', []);

        // 2. Si el producto existe en el carrito, lo removemos
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // 3. REDIRECCIÓN CLAVE: Volver exactamente a la misma vista (el carrito)
        return redirect()->back()->with('success', 'Producto eliminado del carrito exitosamente.');
    }
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Carrito vaciado correctamente.');
    }

    public function checkout()
    {
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'El carrito está vacío.');
    }

    try {
        // Iniciamos una transacción para que todo se guarde junto o nada se rompa
        DB::transaction(function () use ($cart) {
            foreach ($cart as $id => $detalles) {
                // Buscamos el producto directo con bloqueo de lectura para evitar compras simultáneas sin stock
                $producto = Producto::lockForUpdate()->findOrFail((int)$id);

                // Doble chequeo de seguridad de stock en el servidor
                if ($producto->stock < $detalles['cantidad']) {
                    // Lanzamos una excepción para activar el rollback automático
                    throw new \Exception("Lo sentimos, no hay stock suficiente de {$producto->nombre}. Disponible: {$producto->stock} unidades.");
                }

                // Descontamos del stock real de la Base de Datos
                $producto->stock -= $detalles['cantidad'];
                $producto->save();
            }
        });

        // Si la transacción fue exitosa, vaciamos el carrito de la sesión
        session()->forget('cart');

        return redirect()->to('/productos')->with('success', '¡Compra finalizada con éxito! Tu pedido está en camino.');

    } catch (\Exception $e) {
        // Si algo falló (por ejemplo, falta de stock), volvemos con el mensaje exacto del error
        return redirect()->back()->with('error', $e->getMessage());
    }
    }
}

/*
{
    // Ver el carrito
     
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('carrito.index', compact('cart'));
    }

    // Agregar producto al carrito
    public function add($id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        // Si el producto ya está en el carrito, sumamos la cantidad
        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
        } else {
            // Si no existe, lo añadimos con cantidad 1
            $cart[$id] = [
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio,
                "imagen" => $producto->imagen // Por si tienen fotos
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    // Actualizar la cantidad desde el carrito
    public function update(Request $request)
    {
        if($request->id && $request->cantidad){
            $cart = session()->get('cart', []);
            $cart[$request->id]["cantidad"] = $request->cantidad;
            session()->put('cart', $cart);
            session()->flash('success', 'Carrito actualizado');
        }
    }

    // Eliminar un producto del carrito
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart', []);
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado');
        }
    }
}

*/