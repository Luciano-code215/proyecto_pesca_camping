<style>
    body {
        background-color: #b5b7c4 !important;
    }

    /* Aseguramos que el contenedor del enlace permita posicionar la línea */
    .navbar-nav .nav-item {
        position: relative;
    }

    /* Estilo base para todos los enlaces del navbar */
    .navbar-nav .nav-link {
        position: relative;
        padding-bottom: 8px !important;
        /* Espacio obligatorio para la línea */
        display: inline-block;
        /* Evita que Bootstrap colapse el tamaño del enlace */
    }

    /* Forzamos el subrayado únicamente cuando tenga la clase activa de Bootstrap */
    .navbar-nav .nav-link.active::after,
    .navbar-nav .show>.nav-link::after {
        /* Esto mantiene la línea si el menú desplegable está abierto */
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 3px;
        /* Grosor de la línea */
        background-color: #d83333 !important;
        /* Color dorado/amarillo de Bootstrap */
        border-radius: 2px;
        animation: slideIn 0.25s ease forwards;
    }

    /* Animación de entrada de la línea */
    @keyframes slideIn {
        from {
            width: 0;
        }

        to {
            width: 100%;
        }
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
                    <a class="nav-link {{ request()->is('/') ? 'active text-warning fw-bold' : '' }}"
                        aria-current="page" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('quienes_somos') ? 'active text-warning fw-bold' : '' }}"
                        href="/quienes_somos">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('comercializacion') ? 'active text-warning fw-bold' : '' }}"
                        href="/comercializacion">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contacto') ? 'active text-warning fw-bold' : '' }}"
                        href="/contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('terminos_y_usos') ? 'active text-warning fw-bold' : '' }}"
                        href="/terminos_y_usos">Terminos y usos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('productos*') ? 'active text-warning fw-bold' : '' }}"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/productos?categoria=pesca">Pesca</a></li>
                        <li><a class="dropdown-item" href="/productos?categoria=camping">Camping</a></li>
                        <li><a class="dropdown-item" href="/productos?categoria=indumentaria">Indumentaria</a></li>
                    </ul>
                </li>
                @auth
                    @if (Auth::user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownAdmin"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-fill-check text-warning"></i> Hola, {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                aria-labelledby="navbarDropdownAdmin">
                                <li>
                                    <a class="dropdown-item" href="/admin/dashboard">
                                        <i class="bi bi-gear-fill text-warning me-2"></i> Administrar Página
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST" class="px-3 py-1">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm w-100 text-start">
                                            <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownUser"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hola, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                aria-labelledby="navbarDropdownUser">
                                <li><a class="dropdown-item" href="{{ url('/mis-compras') }}">Mis Compras</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST" class="px-3 py-1">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('crear-cuenta || ingresar') ? 'active text-warning fw-bold' : '' }}"
                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                            aria-labelledby="navbarDropdownGuest">
                            <li><a class="dropdown-item" href="{{ url('/ingresar') }}">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="{{ url('/crear_cuenta') }}">Crear Cuenta</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

     <div class="d-flex align-items-center">
          <a href="/carrito" class="btn btn-outline-dark position-relative">
              <i class="bi bi-cart3 fs-5"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : '0'; ?>
              </span>
          </a>
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
