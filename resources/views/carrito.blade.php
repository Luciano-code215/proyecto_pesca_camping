<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>Carrito</title>
</head>

<body>
    @include('navbar')

    <style>
        body {
            background-image: url('{{ asset('img/carrito_fondo.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>

    <div class="container my-5" style="background: rgba(255,255,255,0.95); padding: 30px; border-radius: 10px;">
        <h2 class="mb-4"><i class="bi bi-cart4"></i> Tu Carrito de Compras</h2>

        {{-- Alertas de Éxito o de Error de Stock --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(empty($cart))
            <div class="alert alert-info text-center">
                <p>Tu carrito está vacío actualmente.</p>
                <a href="{{ url('/productos') }}" class="btn btn-primary">Volver a la tienda</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th style="width: 160px;" class="text-center">Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $detalles)
                            @php 
                                $subtotal = $detalles['precio'] * $detalles['cantidad'];
                                $total += $subtotal;
                                
                                // Convertimos el ID de la sesión a entero para asegurar que la BD lo encuentre correctamente
                                $productoBD = \App\Models\Producto::find((int)$id);
                                
                                // Definimos el stock real, si no lo encuentra por las dudas asumimos 0
                                $stockDisponible = $productoBD ? $productoBD->stock : 0;
                            @endphp
                            
                            <tr>
                                <td>
                                    @if(str_contains($detalles['imagen'], 'storage/'))
                                        <img src="{{ asset($detalles['imagen']) }}" width="50" height="50" class="img-thumbnail me-2">
                                    @else
                                        <img src="{{ asset('img/' . $detalles['imagen']) }}" width="50" height="50" class="img-thumbnail me-2">
                                    @endif
                                    <strong>{{ $detalles['nombre'] }}</strong>
                                    <br>
                                    {{-- Mostramos el stock disponible real --}}
                                    <small class="text-muted">Stock disponible: {{ $stockDisponible }} uds.</small>
                                </td>
                                <td>${{ number_format($detalles['precio'], 2, ',', '.') }}</td>
                                
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="decrement">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary py-1 px-2">-</button>
                                        </form>

                                        <span class="fw-bold px-2" style="min-width: 30px;">{{ $detalles['cantidad'] }}</span>

                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="increment">
                                            
                                            {{-- Si el producto no existe en la BD o la cantidad iguala/supera al stock, el botón se bloquea físicamente --}}
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-secondary py-1 px-2"
                                                    @if(!$productoBD || $detalles['cantidad'] >= $stockDisponible) disabled title="Llegaste al límite de stock disponible" @endif>
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                <td>${{ number_format($subtotal, 2, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 w-100">


    {{-- BLOQUE DE BOTONES Y TOTALES --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="d-flex gap-2">
                    <a href="{{ url('/productos') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Seguir Comprando
                    </a>
                    
                    {{-- Formulario para Vaciar Carrito --}}
                    <form action="{{ route('cart.clear') }}" method="POST" class="form-vaciar m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash3"></i> Vaciar Carrito
                        </button>
                    </form>
                </div>
            
                <div class="d-flex align-items-center gap-4 ms-auto">
                    <h4 class="m-0 fw-bold">Total: <span class="text-success">${{ number_format($total, 2, ',', '.') }}</span></h4>
                    
                    {{-- Formulario para Finalizar Compra --}}
                    <form action="{{ route('cart.checkout') }}" method="POST" class="m-0" onsubmit="return confirm('¿Confirmás la compra de los artículos de tu carrito?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                            <i class="bi bi-credit-card-2-back"></i> Finalizar Compra
                        </button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
   
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>


<!--
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ url('/productos') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Seguir Comprando
                </a>
                
                <form action="{{ route('cart.clear') }}" method="POST" class="m-0">
                       @csrf
                       <button type="submit" class="btn btn-outline-danger">
                          <i class="bi bi-trash3"></i> Vaciar Carrito
                        </button>
                  </form>
             </div>


                <div class="text-end d-flex align-items-center gap-3">
                    <h4 class="m-0">Total: <span class="text-success">${{ number_format($total, 2, ',', '.') }}</span></h4>
                    
                    {{-- Formulario para Finalizar Compra --}}
                    <form action="{{ route('cart.checkout') }}" method="POST" onsubmit="return confirm('¿Confirmás la compra de los artículos de tu carrito?');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm">
                            <i class="bi bi-credit-card-2-back"></i> Finalizar Compra
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    @include('footer')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>