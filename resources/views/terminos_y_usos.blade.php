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
    <style>
        body {
            background-image: url('{{ asset('img/terminos_y_usos_fondo.png') }}');
            background-size: cover;
            background-position: center;
        }
    </style>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 class="mb-4 text-primary text-center"> <strong>Términos y Condiciones de Uso</strong></h1>
                <p class="text-muted">Última actualización: {{ date('d/m/Y') }}</p>

                <div class="accordion" id="accordionTerms">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#servicios">
                               <strong> 1. Servicios y Productos Ofrecidos </strong>
                            </button>
                        </h2>
                        <div id="servicios" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Ofrecemos artículos especializados en pesca deportiva y camping. Esto incluye, pero no
                                se limita a, cañas, reels, señuelos, carpas y accesorios de camping. Los servicios
                                incluyen asesoramiento técnico y comercialización minorista/mayorista.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#privacidad">
                                <strong>2. Políticas de Privacidad</strong>
                            </button>
                        </h2>
                        <div id="privacidad" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Sus datos personales son tratados con absoluta confidencialidad de acuerdo a la Ley N°
                                25.326 de Protección de Datos Personales de Argentina. Solo recopilamos información
                                necesaria para el procesamiento de envíos y facturación.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#ventas">
                                <strong>3. Procedimientos de Venta</strong>
                            </button>
                        </h2>
                        <div id="ventas" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Los precios están expresados en Pesos e incluyen IVA. La compra se perfecciona al
                                confirmar el pago mediante nuestras pasarelas autorizadas o transferencias bancarias.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#envios">
                                <strong>4. Formas de Entrega y Tiempos</strong>
                            </button>
                        </h2>
                        <div id="envios" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <ul>
                                    <li><strong>Retiro en Local:</strong> Sin cargo en nuestro local en la Ciudad de
                                        Corrientes.</li>
                                    <li><strong>Envíos Locales:</strong> Entregas en el día dentro de la ciudad y
                                        localidades aledañas.</li>
                                    <li><strong>Envíos Nacionales:</strong> Realizados vía transporte o correo privado.
                                        Tiempo estimado: 3 a 7 días hábiles.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#garantia">
                                <strong>5. Garantía y Soporte Postventa</strong>
                            </button>
                        </h2>
                        <div id="garantia" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Todos nuestros productos cuentan con garantía oficial de fábrica por fallas de
                                manufactura (mínimo 6 meses según ley). El soporte postventa está disponible vía
                                WhatsApp o correo electrónico para cualquier duda sobre el uso del equipo adquirido.
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mt-5 p-4 bg-light border rounded">
                    <p class="small mb-0">Para consultas adicionales, puede visitarnos en nuestro local en Corrientes
                        Capital o contactarnos a través de nuestra sección de contacto.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @include('footer')
</body>

</html>
