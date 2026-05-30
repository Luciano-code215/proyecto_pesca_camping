<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Carrito</title>
</head>



<body>

<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-cart4"></i> Tu Carrito de Compras</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info text-center">
            <p>Tu carrito está vacío actualmente.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Volver a la tienda</a>
        </div>
    @parent
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach($cart as $id => $detalles)
                        @php $subtotal = $detalles['precio'] * $detalles['cantidad'] @endphp
                        @php $total += $subtotal @endphp
                        
                        <tr data-id="{{ $id }}">
                            <td>
                                <img src="{{ asset('images/' . $detalles['imagen']) }}" width="50" height="50" class="img-thumbnail me-2">
                                <strong>{{ $detalles['nombre'] }}</strong>
                            </td>
                            <td>${{ number_format($detalles['precio'], 2, ',', '.') }}</td>
                            <td>
                                <input type="number" value="{{ $detalles['cantidad'] }}" class="form-control quantity update-cart" min="1" style="width: 80px;">
                            </td>
                            <td>${{ number_format($subtotal, 2, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-from-cart"><i class="bi bi-trash"></i> Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Seguir Comprando</a>
            <div class="text-end">
                <h4>Total: <span class="text-success">${{ number_format($total, 2, ',', '.') }}</span></h4>
                <a href="{{ route('checkout') }}" class="btn btn-success btn-lg mt-2">Proceder al Pago</a>
            </div>
        </div>
    @endif
</div>

</body>

</html>
