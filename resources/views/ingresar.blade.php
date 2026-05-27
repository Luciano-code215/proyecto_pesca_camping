<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    @include('navbar')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0"
                    style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); border-radius: 15px;">

                    <div class="card-header bg-dark text-white text-center py-4 rounded-top"
                        style="border-radius: 15px 15px 0 0;">
                        <h4 class="mb-0 text-uppercase">Ingresar</h4>
                        <small class="text-light">¡Hola de nuevo, pescador!</small>
                    </div>

                    <div class="card-body p-4">
                        <form action="/ingresar" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-envelope text-primary"></i></span>
                                    <input type="email" class="form-control border-start-0" id="email"
                                        name="email" placeholder="tu@email.com" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-lock text-primary"></i></span>
                                    <input type="password" class="form-control border-start-0" id="password"
                                        name="password" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Recordarme en este equipo</label>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg text-white shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                                </button>
                            </div>

                            <hr class="my-4">

                            <div class="text-center">
                                <p class="mb-1">
                                    <a href="/en_construccion" class="text-decoration-none text-muted small">¿Olvidaste
                                        tu
                                        contraseña?</a>
                                </p>
                                <p class="mb-0">
                                    ¿No tenés cuenta? <a href="/crear_cuenta"
                                        class="text-primary fw-bold text-decoration-none">Registrate acá</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLoginExitoso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-door-open-fill"></i> ¡Bienvenido!
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <p class="fs-5 mt-2">{{ session('success') }}</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-primary px-4">OK</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLoginError" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalLabel">
                        <i class="bi bi-door-open-fill"></i> Credenciales incorrectas
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <p class="fs-5 mt-2">{{ session('error') }}</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ url('/ingresar') }}" class="btn btn-primary px-4">OK</a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var miModal = new bootstrap.Modal(document.getElementById('modalLoginExitoso'));
                miModal.show();
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var miModal = new bootstrap.Modal(document.getElementById('modalLoginError'));
                miModal.show();
            });
        </script>
    @endif

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
