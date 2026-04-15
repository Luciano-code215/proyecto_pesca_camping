<!DOCTYPE html>
<html>

<head>

    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    @include('navbar')

    @include('partials.breadcrumbs')

    @if (request()->query('categoria') == 'pesca')
        <div class="container text-center mt-4 mb-4">
            <div class="row row-cols-2 row-cols-md-4 g-2 justify-content-center">
                <div class="col">
                    <a href="/productos?categoria=pesca" class="btn btn-dark w-100">Ver Todo</a>
                </div>
                <div class="col">
                    <a href="/productos?categoria=pesca&tipo=caña" class="btn btn-dark w-100">Cañas</a>
                </div>
                <div class="col">
                    <a href="/productos?categoria=pesca&tipo=reel" class="btn btn-dark w-100">Reels</a>
                </div>
                <div class="col">
                    <a href="/productos?categoria=pesca&tipo=accesorio" class="btn btn-dark w-100">Accesorios</a>
                </div>
            </div>
        </div>
    @endif

    <div class="container text-center">
        <div class="row">

            @foreach ($productos as $producto)
                <div class="col-12 col-md-6 col-lg-3 mb-4 mt-4">
                    <div class="card h-100 shadow-sm border-0" onmouseover="this.classList.add('shadow-lg')"
                        onmouseout="this.classList.remove('shadow-lg')" style="transition: all 0.3s;">

                        <a href="#">
                            <img src="{{ asset('img/' . $producto['img']) }}" class="card-img-top"
                                alt="{{ $producto['nombre'] }}">
                        </a>

                        <div class="card-body d-flex flex-column">

                            <p class="card-text text-center">
                                <a href="#" class="fw-bold text-decoration-none text-dark">
                                    {{ $producto['nombre'] }}
                                </a>
                            </p>

                            <h2 class="text-danger text-center">$ {{ number_format($producto['precio'], 0, ',', '.') }}
                            </h2>

                            <h5 class="text-center">{!! $producto['descripcion'] !!}</h5>

                            <div class="mt-auto pt-3">
                                <button type="button" class="btn btn-primary w-100">Agregar al carrito</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    @include('footer')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
