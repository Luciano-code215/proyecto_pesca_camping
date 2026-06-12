<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Orden;
use App\Models\ItemOrden;

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

        if (isset($cart[$id])) {
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
        $id = (int) $id;

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
        if (isset($cart[$id])) {
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
            // Iniciamos la transacción segura
            DB::transaction(function () use ($cart) {

                // 1. Creamos la Orden base (Padre)
                $orden = new Orden();
                // Si tenés sistema de usuarios/auth, vinculamos el ID. Si no, usá nulled o el dato de tu app.
                $orden->user_id = Auth::id();
                $orden->estado = 'creada'; // Estado inicial de la orden
                $orden->total = 0.0; // Se iniciará en 0.0 para coincidir con el tipo decimal
                $orden->save();

                // 2. Iteramos los productos del carrito para validar stock y crear los ítems
                foreach ($cart as $id => $detalles) {

                    // Buscamos el producto con bloqueo de fila para evitar compras simultáneas sin stock
                    $producto = Producto::lockForUpdate()->findOrFail((int) $id);

                    // Doble chequeo de seguridad de stock en el servidor
                    if ($producto->stock < $detalles['cantidad']) {
                        throw new \Exception("Lo sentimos, no hay stock suficiente de {$producto->nombre}. Disponible: {$producto->stock} unidades.");
                    }

                    // 🟢 A. Descontamos del stock real del Producto y guardamos
                    $producto->descontarStock($detalles['cantidad']);


                    // 🟢 B. Creamos el renglón del detalle (ItemOrden) vinculado a la orden
                    $item = new ItemOrden();
                    $item->orden_id = $orden->id; // El ID de la orden que acabamos de crear arriba
                    $item->producto_id = $producto->id;
                    $item->cantidad = $detalles['cantidad'];

                    // Guardamos el precio unitario del momento exacto de la compra (historial)
                    $item->precio_unitario = $detalles['precio'];

                    // Al hacer save(), el evento 'booted' calculará el subtotal 
                    // y actualizará el 'total' general de la $orden de forma automática.
                    $item->save();
                }
            });

            // Si la transacción fue exitosa (todo se guardó perfectamente), vaciamos la sesión
            session()->forget('cart');

            return redirect()->to('/productosPub')->with('compra_finalizada', '¡Compra finalizada con éxito! Nuestro personal se pondra en contactio al mail ' . Auth::user()->email . ' para coordinar la entrega.');

        } catch (\Exception $e) {
            // Si saltó la excepción de stock o algún fallo de BD, la transacción hace Rollback 
            // automáticamente: no se crea la orden, ni los ítems, ni se descuenta stock.
            return redirect()->to('/productosPub')->with('compra_error', $e->getMessage());
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