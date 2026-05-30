<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Carrito</title>
</head>

<body>



@foreach($items as $item) <tr>     
    <td>{{ $item->producto->nombre }}</td>     
    <td>{{ $item->cantidad }}</td>     
    <td>${{ number_format($item->precio_unitario, 2) }}</td>     
    <td>${{ number_format($item->subtotal, 2) }}</td>     
    <td>         {{-- Botón eliminar con método DELETE --}}         
        <form method='POST' action="{{ route('carrito.eliminar', $item->id) }}">            
             @csrf             @method('DELETE')             
             <button type='submit'>Eliminar</button>         
            </form>     </td> </tr> 
            @endforeach {{-- Botón confirmar compra --}} 
            <form method='POST' action="{{ route('carrito.confirmar') }}">     
                @csrf     
                <button type='submit'>Confirmar compra</button> 
            </form> 

</body>

</html>