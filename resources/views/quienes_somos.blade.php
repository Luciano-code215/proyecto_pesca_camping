<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>


<body>
    @include('navbar')

    <style>
        body {
            background-image: url('{{ asset('img/quienes_somos_fondo.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>

    <div class="container py-5">
        <div class="row mb-5 align-items-center">
            <div class="col-lg-12">
                <h2 class="display-4 fw-bold mb-4">Nuestra Trayectoria</h2>
                <p class="lead text-muted">
                    Desde nuestra fundación en 2010, hemos recorrido un camino de innovación constante,
                    pasando de ser un pequeño equipo local a convertirnos en referentes del sector.
                </p>
                <p>
                    Nuestra misión es proporcionar soluciones de alta calidad que superen las expectativas
                    de nuestros clientes, manteniendo siempre la integridad y la excelencia operativa.
                </p>
                <div class="mt-4">
                    <h4 class="fw-semibold">Objetivos Principales:</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent border-0 ps-0">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i> Liderar el mercado regional.
                        </li>
                        <li class="list-group-item bg-transparent border-0 ps-0">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i> Innovación tecnológica sostenible.
                        </li>
                        <li class="list-group-item bg-transparent border-0 ps-0">
                            <i class="bi bi-check-circle-fill text-primary me-2"></i> Desarrollo profesional del talento
                            humano.
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Nuestro Equipo</h2>
            <p class="text-muted">El talento humano detrás de nuestros logros.</p>
        </div>
    </div>


    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-4">
            <img src="{{ asset('img/camilo_gomez_pesca.jpg') }}" alt="Persona 1" class="rounded-circle mb-2"
                width="120" height="120">
            <h5>Camilo Gómez</h5>
            <p>Propietario – apasionado de la vida al aire libre, iniciador de nuestro proyecto.</p>
        </div>
        <div class="col-md-4 mb-4">
            <img src="{{ asset('img/lucas_diaz_pesca.png') }}" alt="Persona 2" class="rounded-circle mb-2"
                width="120" height="120">
            <h5>Lucas Díaz</h5>
            <p>Coordinador general – se encarga de las compras, relacion con proveedores y redes sociales.</p>
        </div>
        <div class="col-md-4 mb-4">
            <img src="{{ asset('img/andres_perez_pesca.png') }}" alt="Persona 3" class="rounded-circle mb-2"
                width="120" height="120">
            <h5>Andres Pérez</h5>
            <p>Vendedor – responsable de la atencion personalizada en nuestro local.</p>
        </div>
    </div>

    @include('footer')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
