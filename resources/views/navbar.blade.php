<style>
    body {
        background-color: #b5b7c4 !important;
    }
</style>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-0 sticky-top">
    <div class="container-fluid py-0">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/logo_parana.png') }}" height="60" class="d-inline-block align-top" alt="Paraná">
        </a>
        <button class="navbar-toggler oder-first" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav fw-bold">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                        href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('quienes_somos') ? 'active' : '' }}"
                        href="/quienes_somos">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('comercializacion') ? 'active' : '' }}"
                        href="/comercializacion">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contacto') ? 'active' : '' }}" href="/contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('terminos_y_usos') ? 'active' : '' }}"
                        href="/terminos_y_usos">Terminos y usos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('productos*') ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/productos?categoria=pesca">Pesca</a></li>
                        <li><a class="dropdown-item" href="/productos?categoria=camping">Camping</a></li>
                        <li><a class="dropdown-item" href="/productos?categoria=indumentaria">Indumentaria</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('ingresar') || request()->is('crear_cuenta') ? 'active' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <ul class="navbar-nav flex-row ms-auto">
        <li class="nav-item me-3">
            <a class="nav-link fs-3" href="/en_construccion"><i class="bi bi-whatsapp"></i></a>
        </li>
        <li class="nav-item me-3">
            <a class="nav-link fs-3" href="/en_construccion"><i class="bi bi-instagram"></i></a>
        </li>
    </ul>
</nav>
