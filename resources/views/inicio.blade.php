<!DOCTYPE html>
<html>

<head>
    <title>Paraná pesca</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    @include('navbar')

    <div class="container-sm text-center mt-4 mb-4">
        <div class="row align-items-center justify-content-center">
            <div class="col-4">

            </div>
            <div class="col-4">
                <img src="{{ asset('img/logo-con-bienvenida (1).png') }}"
                    class="img-fluid animate__animated animate__fadeInDown" alt="Portada">
            </div>
            <div class="col">

            </div>
        </div>
    </div>


    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-pause="false" data-bs-ride="carousel"
        data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/carrousel-inicio1.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/carrousel-inicio2.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/carrousel-inicio3.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-fluid text-center mt-5 mb-5">
        <h3 class="mb-4">Nuestras Marcas</h3>

        <div class="row align-items-center justify-content-center g-4">

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/redfish.png') }}" class="img-fluid" alt="Redfish" style="max-height: 60px;">
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/x-fish.png') }}" class="img-fluid" alt="Xfish" style="max-height: 60px;">
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/marine-sport.png') }}" class="img-fluid" alt="Marine Sport"
                    style="max-height: 60px;">
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/abu-garcia.png') }}" class="img-fluid" alt="Abu Garcia"
                    style="max-height: 60px;">
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/albatros.png') }}" class="img-fluid" alt="Albatros" style="max-height: 60px;">
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <img src="{{ asset('img/xoptic.png') }}" class="img-fluid" alt="X-Optic" style="max-height: 60px;">
            </div>

        </div>
    </div>

    <div class="container text-center mt-5 mb-5">
        <h2 class= "text-danger"><strong>OPORTUNIDADES</strong></h2>
        <h4 class= "text-muted"><i>Promociones validas solo para retiro en sucursal</i></h4>
    </div>

    <div class="container px-0">
        <div class = "row">
            <div class = "col-md-6 mb-3 d-flex align-items-center justify-content-center ">
                <img src="{{ asset('img/promocion1.png') }}" class="img-fluid" alt="Promoción 1">
            </div>
            <div class = "col-md-6 mb-3 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/promocion2.png') }}" class="img-fluid" alt="Promoción 2">
            </div>
        </div>

        <div class= "row">
            <div class = "col-md-12 mb-3 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/promocion3.png') }}" class="img-fluid" alt="Promoción 3">
            </div>
        </div>
    </div>

    <div class= "container mt-5 mb-5">
        <div class= "row">
            <div class= "col-md-4 mb-3 align-items-center justify-content-center">
                <a href="/productos?categoria=pesca&tipo=reels" class="zoom-link"
                    style="display: block; overflow: hidden;">
                    <img src="{{ asset('img/banner-reels.png') }}" class="img-fluid rounded" alt="banner reels">
                </a>
            </div>
            <div class= "col-md-4 mb-3 align-items-center justify-content-center">
                <a href= "/productos?categoria=pesca&tipo=cañas" class="zoom-link"
                    style="display: block; overflow: hidden;">
                    <img src="{{ asset('img/banner-cañas.png') }}" class="img-fluid rounded" alt="banner cañas">
                </a>
            </div>
            <div class= "col-md-4 mb-3 align-items-center justify-content-center">
                <a href= "/productos?categoria=pesca&tipo=accesorios" class="zoom-link"
                    style="display: block; overflow: hidden;">
                    <img src="{{ asset('img/banner-señuelos.png') }}" class="img-fluid rounded"
                        alt="banner señuelos">
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center mt-5 mb-5">
        <div class= "row align-items-center justify-content-center bg-white bg-opacity-25">
            <div class= "col-6 col-lg-3 text-center align-items-center justify-content-center">
                <i class="bi bi-box-seam fs-1"></i>
                <h5><strong>ENVÍOS A TODO EL PAÍS</strong></h5>
            </div>
            <div class= "col-6 col-lg-3 text-center align-items-center justify-content-center">
                <i class="bi bi-credit-card fs-1"></i>
                <h5><strong>VARIEDAD EN METODOS DE PAGO</strong></h5>
            </div>
            <div class= "col-6 col-lg-3 text-center align-items-center justify-content-center d-none d-lg-block">
                <i class="bi bi-currency-dollar fs-1"></i>
                <h5><strong>DESCUENTOS CON PAGO EN EFECTIVO</strong></h5>
            </div>
            <div class= "col-6 col-lg-3 text-center align-items-center justify-content-center d-none d-lg-block">
                <i class="bi bi-whatsapp fs-1"></i>
                <h5><strong>CONSULTAS VIA WHATSAPP</strong></h5>
            </div>
        </div>
    </div>



    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @include('footer')
</body>

</html>
