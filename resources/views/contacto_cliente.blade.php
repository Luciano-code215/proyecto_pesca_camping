<!DOCTYPE html>
<html>
{{-- FORMULARIO DE CONTACTO PARA CLIENTES --}}

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
            background-attachment: fixed;
        }
    </style>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white py-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-envelope me-2"></i>Contactanos</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('contacto.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label Gaza for="nombre" class="form-label fw-semibold">Nombre Completo</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombre" name="nombre" placeholder="Ej: Juan Pérez"
                                    value="{{ old('nombre') }}" required>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="nombre@ejemplo.com"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="asunto" class="form-label fw-semibold">Asunto</label>
                                <input type="text" class="form-control @error('asunto') is-invalid @enderror"
                                    id="asunto" name="asunto"
                                    placeholder="Ej: Consulta sobre stock, Envios, Presupuestos"
                                    value="{{ old('asunto') }}" required>
                                @error('asunto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="celular" class="form-label fw-semibold">Celular</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" class="form-control @error('celular') is-invalid @enderror"
                                        id="celular" name="celular" placeholder="Ej: 912345678" inputmode="numeric"
                                        pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        value="{{ old('celular') }}" required>
                                    @error('celular')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="mensaje" class="form-label fw-semibold">Tu Mensaje</label>
                                <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4"
                                    placeholder="¿En qué podemos ayudarte?" required>{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary text-white fw-bold py-2">
                                    <i class="bi bi-send me-1"></i> Enviar Mensaje
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('mensaje_exito'))
        <div class="modal fade" id="mensajeGracias" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title fw-bold"><i class="bi bi-check-circle-fill me-2"></i>¡Gracias por tu
                            mensaje!</h5>
                    </div>
                    <div class="modal-body py-4">
                        <p class="fs-5">Hola <strong>{{ session('nombre_usuario') }}</strong>,</p>
                        <p class="text-muted mb-0">Hemos recibido tu consulta de manera correcta. Un asesor se
                            contactará a la brevedad al correo: <strong>{{ session('email_usuario') }}</strong>.</p>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <a href="{{ url('/') }}" class="btn btn-primary fw-bold px-4">
                            Entendido
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if (session('mensaje_exito'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var element = document.getElementById('mensajeGracias');
                var myModal = new bootstrap.Modal(element);
                myModal.show();
            });
        </script>
    @endif
</body>

</html>
