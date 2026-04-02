<!DOCTYPE html>
<html>

<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-0">
        <div class="container-fluid py-0">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo_parana.png') }}" height="60" class="d-inline-block align-top" alt="Paraná">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Contacto</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pesca</a></li>
                            <li><a class="dropdown-item" href="#">Camping</a></li>
                            <li><a class="dropdown-item" href="#">Indumentaria</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Ingresar</a></li>
                            <li><a class="dropdown-item" href="#">Registrarse</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="{{ asset('img/portada-parana.png') }}" class="img-fluid" alt="Portada">

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>