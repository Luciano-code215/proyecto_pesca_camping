<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - @yield('titulo', 'Paraná Pesca')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        body {
            overflow-x: hidden;
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            width: 250px;
            position: fixed;
            z-index: 1000;
        }

        .sidebar .brand-link {
            display: block;
            padding: 15px;
            font-size: 1.15rem;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid #4b545c;
        }

        .sidebar .nav-link {
            color: #c2c7d0;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 4px;
            margin: 0 10px;
            padding: 12px 10px;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-3 col-lg-2 bg-dark text-white p-3 sidebar-scrollable">

                <div class="d-flex align-items-center justify-content-between pb-3 border-bottom border-secondary">
                    <span class="fs-5 fw-bold text-warning"><i class="bi bi-hook me-2"></i>Paraná Pesca</span>

                    <button class="btn btn-outline-light d-md-none border-0 fs-3 p-0 px-2" type="button"
                        data-bs-toggle="collapse" data-bs-target="#menuAdmin" aria-controls="menuAdmin"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <div class="collapse d-md-block mt-3" id="menuAdmin">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a href="{{ url('/admin/dashboard') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/dashboard') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-speedometer2 me-2"></i> Inicio
                            </a>
                        </li>

                        <div class="text-uppercase text-muted px-2 pt-3 pb-1 small fw-bold" style="font-size: 0.7rem;">
                            Gestión de Tienda</div>

                        <li class="nav-item">
                            <a href="{{ url('/admin/productos') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/productos*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-box-seam-fill text-warning me-2"></i> Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/categorias') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/categorias*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-tags-fill text-info me-2"></i> Categorías
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/pedidos') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/pedidos*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-cart-check-fill text-success me-2"></i> Pedidos/Ventas
                            </a>
                        </li>

                        <div class="text-uppercase text-muted px-2 pt-3 pb-1 small fw-bold" style="font-size: 0.7rem;">
                            Mensajería</div>

                        <li class="nav-item">
                            <a href="{{ url('/admin/contactos') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/contactos*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-envelope-fill text-danger me-2"></i> Contactos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/consultas') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/consultas*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-chat-left-text-fill text-primary me-2"></i> Consultas
                            </a>
                        </li>

                        <div class="text-uppercase text-muted px-2 pt-3 pb-1 small fw-bold" style="font-size: 0.7rem;">
                            Reportes y Seguridad</div>

                        <li class="nav-item">
                            <a href="{{ url('/admin/informes') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/informes*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-graph-up-arrow me-2"></i> Informes de Venta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/usuarios') }}"
                                class="nav-link text-white py-2 {{ request()->is('admin/usuarios*') ? 'active bg-primary rounded' : '' }}">
                                <i class="bi bi-people-fill me-2"></i> Gestionar Usuarios
                            </a>
                        </li>
                        <hr class="text-secondary my-3">

                        <li class="nav-item mb-3">
                            <a href="{{ url('/') }}"
                                class="btn btn-outline-warning w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-arrow-left-circle"></i> Volver a la Tienda
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-9 col-lg-10 p-4">
                @yield('contenido')
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
