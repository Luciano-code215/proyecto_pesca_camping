<!DOCTYPE html>
<html>

<head>
    <title>Nueva Consulta</title>
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
                        <h4 class="mb-0 fw-bold"><i class="bi bi-chat-left-text me-2"></i>Nueva Consulta de Usuario</h4>
                    </div>
                    <div class="card-body p-4 text-dark">

                        <div class="alert alert-info border-0 small mb-4" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            Estás navegando como usuario registrado. Tu consulta se asociará automáticamente a tu
                            perfil.
                        </div>

                        <form action="{{ route('consultas.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tu Nombre</label>
                                <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}"
                                    readonly disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted">Tu Correo Electrónico</label>
                                <input type="email" class="form-control bg-light" value="{{ auth()->user()->email }}"
                                    readonly disabled>
                            </div>

                            <div class="mb-3">
                                <label Gaza for="asunto" class="form-label fw-semibold">Asunto de la Consulta</label>
                                <input type="text" class="form-control @error('asunto') is-invalid @enderror"
                                    id="asunto" name="asunto"
                                    placeholder="Ej: Estado de mi pedido, Soporte técnico, Dudas de facturación"
                                    value="{{ old('asunto') }}" required>
                                @error('asunto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="mensaje" class="form-label fw-semibold">Detalle de tu Consulta</label>
                                <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" rows="4"
                                    placeholder="Escribe aquí los detalles..." required>{{ old('mensaje') }}</textarea>
                                @error('mensaje')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary text-white fw-bold py-2">
                                    <i class="bi bi-send me-1"></i> Enviar Consulta
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
                        <h5 class="modal-title fw-bold"><i class="bi bi-check-circle-fill me-2"></i>¡Consulta Recibida!
                        </h5>
                    </div>
                    <div class="modal-body py-4">
                        <p class="fs-5">Hola <strong>{{ session('nombre_usuario') }}</strong>,</p>
                        <p class="text-muted mb-0">Hemos registrado tu ticket de consulta correctamente. Te enviaremos
                            una notificación al correo: <strong>{{ session('email_usuario') }}</strong> en cuanto un
                            asesor tome tu caso.</p>
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
