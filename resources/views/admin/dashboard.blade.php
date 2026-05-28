@extends('layouts.admin')

@section('titulo', 'Panel de Control')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Panel de Control General</h3>
        <span class="badge bg-primary p-2">Resumen del Estado del Sitio</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-primary border-4">
                <div class="fs-1 text-primary me-3"><i class="bi bi-box-seam-fill text-warning"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Total Productos</h6>
                    <h4 class="mb-0 fw-bold">142</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-danger border-4">
                <div class="fs-1 text-danger me-3"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Mensajes Contacto</h6>
                    <h4 class="mb-0 fw-bold">4 nuevos</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-info border-4">
                <div class="fs-1 text-info me-3"><i class="bi bi-chat-left-text-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Consultas Clientes</h6>
                    <h4 class="mb-0 fw-bold">2 nuevas</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 p-4 bg-white">
        <h5 class="fw-bold text-dark"><i class="bi bi-hand-thumbs-up text-success me-2"></i>¡Hola de nuevo, Luciano!</h5>
        <p class="text-muted mb-0">
            Desde este panel vas a poder controlar los productos de tu tienda de pesca y camping, revisar las preguntas que
            te dejaron los usuarios registrados y responder los correos del formulario de contacto. Usa la barra lateral de
            la izquierda para navegar.
        </p>
    </div>
@endsection
