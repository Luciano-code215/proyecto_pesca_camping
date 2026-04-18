<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    @include('navbar')

     <style>
        body {
            background-image: url('{{ asset('img/comercializacion_fondo2.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        background-color: #f1ebd8;
    </style>

<section class="container my-5">
    <div class="row text-center g-4">
        
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="mb-4">Medios de Pago</h3>
                    <div class="row g-3">
                        <div class="col-6">
                            <i class="bi bi-credit-card-2-back fs-1 text-primary"></i>
                            <p class="mt-2 fw-bold">Tarjetas de Crédito y Débito</p>
                            <small class="text-muted">Visa, Mastercard, Maestro, Cabal</small>
                        </div>
                        <div class="col-6">
                            <i class="bi bi-cash-stack fs-1 text-success"></i>
                            <p class="mt-2 fw-bold">Efectivo</p>
                            <small class="text-muted">Rapipago, Pago Fácil</small>
                        </div>
                        <div class="col-12 mt-4">
                            <i class="bi bi-bank fs-1 text-info"></i>
                            <p class="mt-2 fw-bold">Transferencias Bancarias</p>
                            <small class="text-muted">CBU / Alias (Acreditación inmediata)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm bg-light">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h3 class="mb-4">Envíos a todo el país</h3>
                    <div class="mb-3">
                        <i class="bi bi-truck fs-1 text-dark"></i>
                    </div>
                    <p class="lead">Llegamos a cada rincón de <strong>Argentina</strong>.</p>
                    <ul class="list-unstyled text-start d-inline-block mx-auto">
                        <li><i class="bi bi-check2-circle text-success"></i> Envíos por Correo Argentino / Andreani</li>
                        <li><i class="bi bi-check2-circle text-success"></i> Retiro en puntos de entrega</li>
                        <li><i class="bi bi-check2-circle text-success"></i> Seguimiento online de tu pedido</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-primary p-2">Interior de Corrientes y Chaco: 24-48 hs</span>
                        <span class="badge bg-secondary p-2">Resto del pais: 3-6 días hábiles</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>



    @include('footer')
</body>
</html>