<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    {{-- Navbar principal corregido --}}
    @include('navbar')

    {{-- Breadcrumbs de navegación --}}
    @include('partials.breadcrumbs')

    {{-- LISTADO DE CATEGORÍAS COMPLETO DESDE LA BASE DE DATOS --}}
    <div class="container text-center mt-4 mb-2">
        <h5 class="text-muted mb-3">Categorías</h5>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            {{-- Botón para quitar filtros y ver absolutamente todo --}}
            <a href="/productosPub"
                class="btn {{ !request()->query('categoria') ? 'btn-primary' : 'btn-outline-primary' }}">
                Ver Todo el Catálogo
            </a>

            {{-- Recorremos dinámicamente las categorías de la BD --}}
            @foreach ($categoriasMenu as $catMenu)
                <a href="/productosPub?categoria={{ $catMenu->id }}"
                    class="btn {{ request()->query('categoria') == $catMenu->id ? 'btn-primary' : 'btn-outline-primary' }}">
                    {{ ucfirst($catMenu->nombre) }}
                </a>
            @endforeach
        </div>
    </div>

    <hr class="container my-3">

    {{-- Grilla Dinámica de Productos desde la Base de Datos --}}
    <div class="container text-center">
        <div class="row">
            @if ($productos->isEmpty())
                <div class="col-12 my-5">
                    <div class="alert alert-info">
                        No hay productos disponibles para los filtros seleccionados actualmente.
                    </div>
                </div>
            @else
                @foreach ($productos as $producto)
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mt-4">
                        <div class="card h-100 shadow-sm border-0" onmouseover="this.classList.add('shadow-lg')"
                            onmouseout="this.classList.remove('shadow-lg')" style="transition: all 0.3s;">

                            {{-- Imagen dinámica controlando si viene de Storage o carpeta img --}}
                            @if (str_contains($producto->url_imagen, 'storage/'))
                                <img src="{{ asset($producto->url_imagen) }}" class="card-img-top"
                                    alt="{{ $producto->nombre }}">
                            @else
                                <img src="{{ asset('img/' . $producto->url_imagen) }}" class="card-img-top"
                                    alt="{{ $producto->nombre }}">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-start mb-1">{{ $producto->nombre }}</h5>

                                <h3 class="text-danger text-start mt-2">
                                    $ {{ number_format($producto->precio, 2, ',', '.') }}
                                </h3>

                                <div class="text-muted text-start small mb-3">
                                    {!! $producto->descripcion !!}
                                </div>

                                {{-- Formulario funcional para agregar al carrito --}}
                                <div class="mt-auto pt-3">
                                    <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-cart-plus"></i> Agregar al carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @if (session('compra_finalizada') || session('compra_error'))
        <div class="modal fade" id="modalStatusCompra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">

                    {{-- Encabezado condicional según el resultado --}}
                    <div class="modal-header border-0 {{ session('compra_finalizada') ? 'bg-success text-white' : 'bg-danger text-white' }}"
                        style="border-radius: .3rem .3rem 0 0;">
                        <h5 class="modal-title fw-bold" id="modalStatusLabel">
                            @if (session('compra_finalizada'))
                                <i class="bi bi-check-circle-fill me-2"></i> ¡Operación Exitosa!
                            @else
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Hubo un problema
                            @endif
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    {{-- Cuerpo del Modal --}}
                    <div class="modal-body text-center p-4">
                        @if (session('compra_finalizada'))
                            <div class="text-success display-2 mb-3">
                                <i class="bi bi-bag-check"></i>
                            </div>
                            <p class="fs-5 fw-semibold text-dark mb-1">¡Gracias por tu compra!</p>
                            <p class="text-secondary">{{ session('compra_finalizada') }}</p>
                        @else
                            <div class="text-danger display-2 mb-3">
                                <i class="bi bi-cart-x"></i>
                            </div>
                            <p class="fs-5 fw-semibold text-dark mb-1">No se pudo procesar el pedido</p>
                            <p class="text-secondary">{{ session('compra_error') }}</p>
                        @endif
                    </div>

                    {{-- Pie del Modal con botones de acción --}}
                    <div class="modal-footer border-0 justify-content-center pb-4">
                        @if (session('compra_finalizada'))
                            <a href="{{ url('/productosPub') }}"
                                class="btn btn-success px-4 fw-bold shadow-sm">Entendido,
                                ir a la tienda</a>
                        @else
                            <button type="button" class="btn btn-secondary px-4 fw-bold shadow-sm"
                                data-bs-dismiss="modal">Revisar el carrito</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        {{-- Script automático para levantar el modal --}}
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Inicializamos el modal usando la librería nativa de Bootstrap ya cargada
                var myModal = new bootstrap.Modal(document.getElementById('modalStatusCompra'));
                myModal.show();
            });
        </script>
    @endif

    {{-- Agregamos el footer que tenías en el bloque viejo para mantener consistencia --}}
    @include('footer')

    {{-- JavaScript esencial de Bootstrap Bundle (Llamado una única vez) --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
