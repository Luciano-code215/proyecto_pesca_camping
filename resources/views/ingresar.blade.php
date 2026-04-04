<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
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
                        <form action="/" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i
                                            class="bi bi-envelope text-primary"></i></span>
                                    <input type="email" class="form-control border-start-0" id="email" name="email"
                                        placeholder="tu@email.com" required autofocus>
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
                                    <a href="#" class="text-decoration-none text-muted small">¿Olvidaste tu
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

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>