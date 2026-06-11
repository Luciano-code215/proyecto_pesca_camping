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

    {{-- LISTADO DE CATEGORÍAS COMPLETO DESDE LA BASE DE DATOS --}}
    <div class="container text-center mt-4 mb-2">
        <h5 class="text-muted mb-3">Categorías</h5>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            {{-- Botón para quitar filtros y ver absolutamente todo --}}
            <a href="/productos" class="btn {{ !request()->query('categoria') ? 'btn-primary' : 'btn-outline-primary' }}">
                Ver Todo el Catálogo
            </a>

            {{-- Recorremos dinámicamente las categorías de la BD --}}
            @foreach($categoriasMenu as $catMenu)
                <a href="/productos?categoria={{ $catMenu->id }}" 
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
            @if($productos->isEmpty())
                <div class="col-12 my-5">
                    <div class="alert alert-info">No hay productos disponibles para los filtros seleccionados actualmente.</div>
                </div>
            @else
                @foreach ($productos as $producto)
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mt-4">
                        <div class="card h-100 shadow-sm border-0" onmouseover="this.classList.add('shadow-lg')"
                            onmouseout="this.classList.remove('shadow-lg')" style="transition: all 0.3s;">

                            {{-- Imagen dinámica controlando si viene de Storage o carpeta img --}}
                            @if(str_contains($producto->url_imagen, 'storage/'))
                                <img src="{{ asset($producto->url_imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            @else
                                <img src="{{ asset('img/' . $producto->url_imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
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

    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>


<!--

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
                    <a href="/productos?categoria=pesca&tipo=cañas" class="btn btn-dark w-100">Cañas</a>
                </div>
                <div class="col">
                    <a href="/productos?categoria=pesca&tipo=reels" class="btn btn-dark w-100">Reels</a>
                </div>
                <div class="col">
                    <a href="/productos?categoria=pesca&tipo=accesorios" class="btn btn-dark w-100">Accesorios</a>
                </div>
            </div>
        </div>
    @endif


    
    <div class="container text-center">
    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                    <img src="{{ asset('img/' . $producto['img']) }}" class="card-img-top"
                            alt="{{ $producto['nombre'] }}">              
                             <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $producto['nombre'] }}</h5>
                    <p class="card-text text-primary fw-bold">${{ number_format($producto['precio'], 2, ',', '.') }}</p>
                    
                    <form action="{{ route('cart.add', ['id' => $producto['id']]) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-cart-plus"></i> Agregar al carrito
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>



    <div class="container text-center">
    <div class="row">
    @foreach ($productos as $producto)
        <div class="col-12 col-md-6 col-lg-3 mb-4 mt-4">
                    <div class="card h-100 shadow-sm border-0" onmouseover="this.classList.add('shadow-lg')"
                        onmouseout="this.classList.remove('shadow-lg')" style="transition: all 0.3s;">

                        <img src="{{ asset('img/' . $producto['img']) }}" class="card-img-top"
                          alt="{{ $producto['nombre'] }}">

                        <div class="card-body d-flex flex-column">

                            <p class="card-text text-center">

                                

                            </p>

                            <h2 class="text-danger text-center">$ {{ number_format($producto['precio'], 0, ',', '.') }}
                            </h2>

                            <h5 class="text-center">{!! $producto['descripcion'] !!}</h5>

                            <div class="mt-auto pt-3">
                                <a href="/en_construccion" class="btn btn-primary w-100">Agregar al carrito</a>
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


