<!DOCTYPE html>
<html>

<head>
    <title>Artículos pesca</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">

</head>

<body>
    @include('navbar')

    <div class="text-center bg-image shadow-1-strong rounded d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('img/cañas.png') }}'); 
            height: 120px; 
            background-size: cover; 
            background-position: center;">

        <a class="btn btn-dark fs-4 fw-bold" data-bs-toggle="collapse" href="#productos-canas" role="button">
            CAÑAS
        </a>
    </div>
    <div class="collapse" id="productos-canas">

        @include("cañas")

    </div>

    <div class="text-center bg-image shadow-1-strong rounded d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('img/banner-reel.png') }}'); 
            height: 120px; 
            background-size: cover; 
            background-position: center;">

        <a class="btn btn-dark fs-4 fw-bold" data-bs-toggle="collapse" href="#productos-reeles" role="button">
            REELES
        </a>
    </div>
    <div class="collapse" id="productos-reeles">
        <div class="card card-body">
            @include("navbar")
        </div>
    </div>

    <div class="text-center bg-image shadow-1-strong rounded d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('img/banner-señuelos.png') }}'); 
            height: 120px; 
            background-size: cover; 
            background-position: center;">

        <a class="btn btn-dark fs-4 fw-bold" data-bs-toggle="collapse" href="#productos-senuelos" role="button">
            SEÑUELOS
        </a>
    </div>
    <div class="collapse" id="productos-senuelos">
        <div class="card card-body">
            @include("navbar")
        </div>
    </div>

    <div class="text-center bg-image shadow-1-strong rounded d-flex align-items-center justify-content-center" style="background-image: url('{{ asset('img/banner-accesorios.png') }}'); 
            height: 120px; 
            background-size: cover; 
            background-position: center;">

        <a class="btn btn-dark fs-4 fw-bold" data-bs-toggle="collapse" href="#productos-accesorios" role="button">
            ACCESORIOS
        </a>
    </div>
    <div class="collapse" id="productos-accesorios">
        <div class="card card-body">
            @include("navbar")
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>