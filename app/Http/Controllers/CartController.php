<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CartController extends Controller
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
