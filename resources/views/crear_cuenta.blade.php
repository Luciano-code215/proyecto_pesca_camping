<!DOCTYPE html>
<html>

<head>
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>
    @include('navbar')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0"
                    style="background-color: rgba(255, 255, 255, 0.9); backdrop-filter: blur(5px);">

                    <div class="card-header bg-dark text-white text-center py-3">
                        <h4 class="mb-0">Crear Cuenta</h4>
                        <small>Unite a la comunidad de Paraná Pesca</small>
                    </div>

                    <div class="card-body p-4">
                        <form action="#" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Ej: Pedro Gómez" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="correo@ejemplo.com" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Mínimo 8 caracteres" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Repetí tu contraseña" required>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg text-white">Registrarme</button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">¿Ya tenés cuenta? <a href="/ingresar"
                                        class="text-primary fw-bold">Iniciá
                                        Sesión</a></p>
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