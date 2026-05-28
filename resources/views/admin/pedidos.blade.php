@extends('layouts.admin')

@section('titulo', 'Gestión de Pedidos')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-cart-check-fill text-success me-2"></i>Historial de Compras y
            Pedidos</h3>
        <span class="text-muted">Monitoreo de ventas de la tienda</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-success text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Ingresos Mensuales</h6>
                <h2 class="fw-bold mb-1">$340.500</h2>
                <p class="mb-0 small">Simulación de caja total facturada</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-warning text-dark p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-truck"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Pendientes de Envío</h6>
                <h2 class="fw-bold mb-1">5</h2>
                <p class="mb-0 small">Paquetes por armar o despachar</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-secondary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Pedidos Completados</h6>
                <h2 class="fw-bold mb-1">128</h2>
                <p class="mb-0 small">Transacciones finalizadas con éxito</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-success border-3 p-4 bg-white">

        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-funnel text-secondary me-2"></i>Buscador y Filtros Avanzados</h5>
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-4">
                <label class="form-label small fw-bold text-muted">Filtrar por Estado</label>
                <select class="form-select">
                    <option value="todos">Todos los estados</option>
                    <option value="pendiente">Pendiente de Pago</option>
                    <option value="pago">Pagado / Listo para enviar</option>
                    <option value="enviado">Enviado / Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            <div class="col-12 col-sm-4">
                <label class="form-label small fw-bold text-muted">Medio de Pago</label>
                <select class="form-select">
                    <option value="todos">Cualquier método</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                    <option value="efectivo">Efectivo / Rapipago</option>
                    <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                </select>
            </div>
            <div class="col-12 col-sm-4 d-flex align-items-end">
                <button type="button" class="btn btn-success w-100 fw-bold">
                    <i class="bi bi-search me-1"></i> Aplicar Filtros (Esqueleto)
                </button>
            </div>
        </div>

        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-list-ol text-secondary me-2"></i>Últimas Transacciones
            Registradas</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">N° Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha Estática</th>
                        <th>Total</th>
                        <th>Método</th>
                        <th>Estado Actual</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold">#0842</td>
                        <td>Gómez Carlos</td>
                        <td>28/05/2026</td>
                        <td class="fw-bold text-dark">$85.000</td>
                        <td><span class="badge bg-light text-dark border">Transferencia</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> Pendiente Envío</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Ver Detalle de Compra">
                                <i class="bi bi-eye-fill"></i> Detalle
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold">#0841</td>
                        <td>Fernández María</td>
                        <td>25/05/2026</td>
                        <td class="fw-bold text-dark">$12.300</td>
                        <td><span class="badge bg-light text-dark border">Efectivo</span></td>
                        <td><span class="badge bg-success"><i class="bi bi-check-lg me-1"></i> Entregado</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Ver Detalle de Compra">
                                <i class="bi bi-eye-fill"></i> Detalle
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold">#0840</td>
                        <td>Álvarez Pedro</td>
                        <td>20/05/2026</td>
                        <td class="fw-bold text-dark">$145.000</td>
                        <td><span class="badge bg-light text-dark border">Tarjeta</span></td>
                        <td><span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> Cancelado</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Ver Detalle de Compra">
                                <i class="bi bi-eye-fill"></i> Detalle
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-text mt-3 text-center text-muted">
            <i class="bi bi-info-circle me-1"></i> Nota: Esta tabla es un diseño estático. Más adelante, vas a reemplazar
            estas filas de ejemplo por un ciclo de Blade que recorra tu tabla de ventas o pedidos desde la base de datos.
        </div>

    </div>
@endsection
