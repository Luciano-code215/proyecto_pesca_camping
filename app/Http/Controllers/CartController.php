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
                "imagen" => $producto->url_imagen
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    public function update(Request $request, $id)
    {
        $id = (int) $id;

        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);
        $accion = $request->input('action');

        if (array_key_exists($id, $cart) || isset($cart[$id])) {

            if ($accion === 'increment') {

                if ($cart[$id]['cantidad'] >= $producto->stock) {
                    return redirect()->back()->with('error', "No podés sumar más unidades. El stock máximo disponible de {$producto->nombre} es de {$producto->stock} unidades.");
                }

                $cart[$id]['cantidad']++;

            } elseif ($accion === 'decrement') {
                $cart[$id]['cantidad']--;

                if ($cart[$id]['cantidad'] <= 0) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Producto removido del carrito.');
                }
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cantidad actualizada correctamente.');
        }

        return redirect()->back()->with('error', 'El producto no se encontró en tu carrito.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

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
            DB::transaction(function () use ($cart) {

                $orden = new Orden();
                $orden->user_id = Auth::id();
                $orden->estado = 'creada';
                $orden->total = 0.0;
                $orden->save();

                foreach ($cart as $id => $detalles) {

                    $producto = Producto::lockForUpdate()->findOrFail((int) $id);

                    if ($producto->stock < $detalles['cantidad']) {
                        throw new \Exception("Lo sentimos, no hay stock suficiente de {$producto->nombre}. Disponible: {$producto->stock} unidades.");
                    }

                    $producto->descontarStock($detalles['cantidad']);


                    $item = new ItemOrden();
                    $item->orden_id = $orden->id;
                    $item->producto_id = $producto->id;
                    $item->cantidad = $detalles['cantidad'];

                    $item->precio_unitario = $detalles['precio'];

                    $item->save();
                }
            });

            session()->forget('cart');

            return redirect()->to('/productosPub')->with('compra_finalizada', '¡Compra finalizada con éxito! Nuestro personal se pondra en contactio al mail ' . Auth::user()->email . ' para coordinar la entrega.');

        } catch (\Exception $e) {
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