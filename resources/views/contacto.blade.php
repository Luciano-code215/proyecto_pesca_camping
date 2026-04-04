<!DOCTYPE html>
<html>

<head>
    <title>Contacto</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
</head>

<body>
    @include('navbar')

    <style>
        body {
            background-image: url('{{ asset('img/fondo-contacto.png') }}');
            background-size: cover;
            background-position: center;
        }

        background-color: #f1ebd8;
    </style>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Contactanos</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ej: Juan Pérez" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="nombre@ejemplo.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="celular" class="form-label">Número de Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular"
                                    placeholder="Ej: 3794123456">
                            </div>

                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Tu Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="4"
                                    placeholder="¿En qué podemos ayudarte?" required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary text-white">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>