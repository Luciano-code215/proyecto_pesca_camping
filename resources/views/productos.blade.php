<!DOCTYPE html>
<html>

<head>

    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
</head>

<body>
    @include('navbar')


    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
    </nav>

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

                        <div class="card-body">
                            <p class="card-text">
                                <a href="#" class="text-center fw-bold text-decoration-none text-dark">
                                    {{ $producto['nombre'] }}
                                </a>
                            </p>

                            <h2 class="text-danger text-center">$ {{ number_format($producto['precio'], 0, ',', '.') }}
                            </h2>
                            <h5 class="text-center">{!! $producto['descripcion'] !!}</h5>
                            <button type="button" class="btn btn-primary">Agregar al carrito</button>
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
