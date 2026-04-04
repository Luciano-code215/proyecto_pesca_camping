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
                    <a class="nav-link" href="/contacto">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/pesca">Pesca</a></li>
                        <li><a class="dropdown-item" href="/camping">Camping</a></li>
                        <li><a class="dropdown-item" href="#">Indumentaria</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Cuenta
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/ingresar">Ingresar</a></li>
                        <li><a class="dropdown-item" href="/crear_cuenta">Registrarse</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-nav ms-auto d-flex align-items-center">
        <a class="nav-link px-2 position-relative" href="#">
            <i class="bi bi-cart3 fs-4 text-white"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle d-none"></span>
        </a>

        <a class="nav-link px-2" href="#" target="_blank">
            <i class="bi bi-whatsapp fs-4" style="color: #25D366;"></i>
        </a>

        <a class="nav-link px-2" href="#" target="_blank">
            <i class="bi bi-instagram fs-4" style="color: #E4405F;"></i>
        </a>





    </div>
</nav>