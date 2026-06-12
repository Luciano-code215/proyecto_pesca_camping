<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Órdenes</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    {{-- 🟢 INCLUIDO: Tu barra de navegación principal --}}
    @include('navbar')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-11"> {{-- Ampliado un poco para dar espacio a la nueva columna --}}
                <div class="card shadow-sm border-0">
                    {{-- Encabezado de la tarjeta con estilo oscuro --}}
                    <div class="card-header bg-dark text-light py-3">
                        <h4 class="mb-0 fw-bold d-flex align-items-center">
                            <i class="bi bi-box-seam me-2 text-warning"></i> Mis Órdenes de Compra
                        </h4>
                    </div>

                    <div class="card-body bg-light">
                        {{-- Si el usuario no tiene ninguna orden guardada --}}
                        @if ($ordenes->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-cart-x fs-1 text-muted"></i>
                                <h5 class="text-muted mt-3">Todavía no realizaste ninguna compra.</h5>
                                <a href="/productosPub" class="btn btn-primary mt-3">
                                    <i class="bi bi-bag-plus me-1"></i> Ver Catálogo de Productos
                                </a>
                            </div>
                        @else
                            {{-- Tabla responsiva para listar las órdenes --}}
                            <div class="table-responsive">
                                <table
                                    class="table table-hover align-middle bg-white rounded shadow-sm overflow-hidden mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="ps-3">Nro. Orden</th>
                                            <th scope="col">Fecha y Hora</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col" class="text-end">Total</th>
                                            <th scope="col" class="text-center">Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ordenes as $orden)
                                            {{-- 1. LA FILA DE LA TABLA (Solo contenido puramente de tabla) --}}
                                            <tr>
                                                <td class="fw-bold ps-3 text-secondary">
                                                    #{{ str_pad($orden->id, 6, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td>
                                                    {{ $orden->created_at->format('d/m/Y H:i') }} hs
                                                </td>
                                                <td>
                                                    @switch(strtolower($orden->estado))
                                                        @case('creada')
                                                            <span class="badge bg-info text-dark px-2 py-1.5">Creada</span>
                                                        @break

                                                        @case('entregada')
                                                            <span class="badge bg-secondary px-2 py-1.5">Entregada</span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="badge bg-secondary px-2 py-1.5">{{ ucfirst($orden->estado) }}</span>
                                                    @endswitch
                                                </td>
                                                <td class="fw-bold text-danger text-end fs-5">
                                                    $ {{ number_format($orden->total, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-dark btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalOrden{{ $orden->id }}">
                                                        <i class="bi bi-eye-fill"></i> Ver productos
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach {{-- Cerramos el foreach de las filas primero para no romper el HTML --}}
                                    </tbody>
                                </table>
                            </div>

                            {{-- 2. LOS MODALES (Los creamos en un bucle limpio separado abajo de la tabla) --}}
                            @foreach ($ordenes as $orden)
                                <div class="modal fade" id="modalOrden{{ $orden->id }}" tabindex="-1"
                                    aria-labelledby="modalOrdenLabel{{ $orden->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title fw-bold" id="modalOrdenLabel{{ $orden->id }}">
                                                    <i class="bi bi-receipt me-2 text-warning"></i> Detalle de Orden
                                                    #{{ str_pad($orden->id, 6, '0', STR_PAD_LEFT) }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <p class="mb-1 text-muted small">Fecha de compra:</p>
                                                        <p class="fw-bold">
                                                            {{ $orden->created_at->format('d/m/Y - H:i') }} hs</p>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <p class="mb-1 text-muted small">Estado actual:</p>
                                                        <p class="fw-bold text-uppercase text-primary">
                                                            {{ $orden->estado }}</p>
                                                    </div>
                                                </div>

                                                <h6 class="border-bottom pb-2 fw-bold text-secondary">Productos
                                                    incluidos</h6>

                                                <div class="table-responsive">
                                                    <table class="table table-sm table-borderless align-middle">
                                                        <thead>
                                                            <tr class="text-muted small">
                                                                <th>Producto</th>
                                                                <th class="text-center">Cantidad</th>
                                                                <th class="text-end">Precio Unit.</th>
                                                                <th class="text-end">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orden->detalles as $detalle)
                                                                <tr class="border-bottom text-dark">
                                                                    <td>
                                                                        {{-- ⚠️ Corrección de variables aquí --}}
                                                                        <span
                                                                            class="fw-bold">{{ $detalle->producto->nombre ?? ($detalle->producto_nombre ?? 'Producto') }}</span>
                                                                    </td>
                                                                    <td class="text-center fw-bold bg-light rounded"
                                                                        style="width: 50px;">{{ $detalle->cantidad }}
                                                                    </td>

                                                                    {{-- ⚠️ Si tus columnas en la tabla detalle se llaman distinto (ej: 'precio_unitario'), cambialas acá: --}}
                                                                    <td class="text-end">$
                                                                        {{ number_format($detalle->precio ?? ($detalle->precio_unitario ?? 0), 2, ',', '.') }}
                                                                    </td>
                                                                    <td class="text-end fw-bold">$
                                                                        {{ number_format(($detalle->precio ?? ($detalle->precio_unitario ?? 0)) * $detalle->cantidad, 2, ',', '.') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="row mt-4 pt-3 border-top justify-content-end">
                                                    <div class="col-md-5 text-end">
                                                        <h5 class="fw-bold text-muted mb-1">Total: </h5>
                                                        <h3 class="fw-bold text-danger">$
                                                            {{ number_format($orden->total, 2, ',', '.') }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tu pie de página --}}
    @include('footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
