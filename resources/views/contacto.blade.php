<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <title>Contacto</title>
</head>

<body>
    @include('navbar')
    <div class="container my-5">
        <div class="row g-4">

            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Contacto</h2>
                <div class="card border-0 shadow-sm p-4">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <strong>Razón Social:</strong><br> Paraná Pesca S.A.
                        </li>
                        <li class="mb-3">
                            <strong>Email Consultas:</strong><br> parana_clientes@gmail.com
                        </li>
                        <li class="mb-3">
                            <strong>Email Proveedores:</strong><br> parana_proveedores@gmail.com
                        </li>
                        <li class="mb-3">
                            <strong>Teléfono:</strong><br> +54 3795 101613
                        </li>
                        <li>
                            <strong>Ubicación Física:</strong><br> Cazadores Correntinos 3120, Corrientes,
                            Argentina.<br>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3539.4252818379073!2d-58.81698768871169!3d-27.48714631735143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456b764c43a27b%3A0xa8e21ab208eaa5ef!2sAv.%20Regimiento%20Cazadores%20Correntinos%203120%2C%20W3402%20Corrientes!5e0!3m2!1ses!2sar!4v1776438766984!5m2!1ses!2sar"
                                width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            </iframe>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="fw-bold mb-4">Estamos aquí para ayudarte</h2>
                <div class="d-grid gap-3">
                    <a href="/en_construccion" target="_blank" class="btn btn-outline-success btn-lg">
                        Chatear por WhatsApp
                    </a>

                    <a href="/en_construccion" target="_blank" class="btn btn-outline-danger btn-lg">
                        Visitar nuestro Instagram
                    </a>

                    @auth
                        <a href="{{ route('form.consultas') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-chat-left-text me-2"></i>Ir al Formulario de Consultas
                        </a>
                    @else
                        <a href="{{ route('form.contacto') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-envelope me-2"></i>Ir al Formulario de Contacto
                        </a>
                    @endauth
                </div>
            </div>

        </div>
    </div>
    @include('footer')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
