@extends('layouts.admin')

@section('titulo', 'Consultas de Clientes')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-chat-left-text-fill text-primary me-2"></i>Consultas de Clientes
            (Logueados)</h3>
        <span class="text-muted">Interacciones con usuarios registrados del sitio</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-primary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Total Consultas</h6>
                <h2 class="fw-bold mb-1">48</h2>
                <p class="mb-0 small">Historial acumulado de preguntas</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-danger text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Sin Responder</h6>
                <h2 class="fw-bold mb-1">2</h2>
                <p class="mb-0 small">Mensajes críticos que esperan feedback</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-info text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-check-all"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Respondidas</h6>
                <h2 class="fw-bold mb-1">46</h2>
                <p class="mb-0 small">Consultas atendidas correctamente</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-primary border-3 p-4 bg-white">

        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-funnel text-secondary me-2"></i>Bandeja de Entrada</h5>
        <div class="row g-2 align-items-center mb-4">
            <div class="col-sm-8">
                <select class="form-select border-primary">
                    <option value="todos">Mostrar todas las consultas de la cuenta</option>
                    <option value="pendientes">Ver solo las Pendientes</option>
                    <option value="respondidas">Ver solo las Respondidas</option>
                </select>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-outline-primary w-100 fw-bold"><i class="bi bi-filter"></i> Filtrar
                    Vista</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID Usuario</th>
                        <th>Cliente Logueado</th>
                        <th>Producto / Motivo</th>
                        <th>Fecha Estática</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-warning-light" style="background-color: rgba(255, 193, 7, 0.05);">
                        <td class="ps-3 fw-bold">#USR-502</td>
                        <td>Juan Carlos Rodríguez</td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 250px;">Duda sobre stock: Caña
                                Shimano Alivio</span></td>
                        <td>Hoy, 10:15 AM</td>
                        <td><span class="badge bg-danger"><i class="bi bi-envelope-fill me-1"></i> Pendiente</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-primary" title="Ver mensaje y responder">
                                <i class="bi bi-reply-fill me-1"></i> Atender
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold">#USR-124</td>
                        <td>Aníbal Benítez</td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 250px;">Envío de Carpa Igloo
                                Coleman</span></td>
                        <td>24/05/2026</td>
                        <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Respondido</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                title="Ver historial de conversación">
                                <i class="bi bi-eye-fill me-1"></i> Ver Historial
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold">#USR-319</td>
                        <td>Laura Martínez</td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 250px;">Fallo en pasarela de
                                MercadoPago</span></td>
                        <td>20/05/2026</td>
                        <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Respondido</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                title="Ver historial de conversación">
                                <i class="bi bi-eye-fill me-1"></i> Ver Historial
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-text mt-3 text-center text-muted">
            <i class="bi bi-shield-lock-fill text-info me-1"></i> <strong>Nota de Seguridad:</strong> Este módulo asume que
            los usuarios iniciaron sesión. Al vincular tu Base de Datos, podrás relacionar la tabla de `consultas` con tu
            tabla de `users` a través de la clave foránea `user_id`.
        </div>

    </div>
@endsection
