@extends('layouts.admin')

@section('titulo', 'Gestión de Pedidos')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-cart-check-fill text-success me-2"></i>Historial de Compras y Pedidos
        </h3>
        <span class="text-muted">Monitoreo de ventas de la tienda</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-warning text-dark p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-truck"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Pendientes de Envío</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Orden::obtenerPendientesEnvio()->count() }}</h2>
                <p class="mb-0 small">Paquetes por armar o despachar</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-secondary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Pedidos Completados</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Orden::obtenerEntregadas()->count() }}</h2>
                <p class="mb-0 small">Transacciones finalizadas con éxito</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-success border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-funnel text-secondary me-2"></i>Buscador y Filtros Avanzados</h5>
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-8">
                <label class="form-label small fw-bold text-muted">Filtrar por Estado</label>
                <select class="form-select" id="filtro_estado"
                    onchange="window.location.href = `{{ route('admin.pedidos') }}?estado=${this.value}`">
                    <option value="todos" {{ request('estado') == 'todos' ? 'selected' : '' }}>Todos los estados</option>
                    <option value="pendientePago" {{ request('estado') == 'pendientePago' ? 'selected' : '' }}>Pendiente de
                        Pago</option>
                    <option value="pagada" {{ request('estado') == 'pagada' ? 'selected' : '' }}>Pagada</option>
                    <option value="pendienteEnvio" {{ request('estado') == 'pendienteEnvio' ? 'selected' : '' }}>Pendiente
                        de Envío</option>
                    <option value="entregada" {{ request('estado') == 'entregada' ? 'selected' : '' }}>Entregada</option>
                    <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
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
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes as $orden)
                        <tr>
                            <td class="ps-3 fw-bold">{{ $orden->obtenerCodigoFormateado() }}</td>
                            <td>{{ $orden->user->name }}</td>
                            <td>{{ $orden->obtenerFechaFormateada() }}</td>
                            <td class="fw-bold text-dark">{{ $orden->obtenerTotalMoneda() }}</td>
                            <td>
                                @php
                                    $estadosFinales = ['cancelada', 'entregada'];
                                @endphp

                                <select class="form-select form-select-sm fw-bold selector-estado"
                                    data-orden-id="{{ $orden->id }}" style="width: 160px;"
                                    {{ in_array($orden->estado, $estadosFinales) ? 'disabled' : '' }}>

                                    @foreach (\App\Models\Orden::obtenerEstadosDisponibles() as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ $orden->estado === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalDetalle{{ $orden->id }}" title="Ver Detalle de Compra">
                                    <i class="bi bi-eye-fill"></i> Detalle
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($ordenes as $orden)
        <div class="modal fade" id="modalDetalle{{ $orden->id }}" tabindex="-1"
            aria-labelledby="modalLabel{{ $orden->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold" id="modalLabel{{ $orden->id }}">
                            Detalle de la Orden {{ $orden->obtenerCodigoFormateado() }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3 mb-4 text-start">
                            <div class="col-md-6 border-end">
                                <h6 class="text-muted fw-bold text-uppercase small">Datos del Cliente</h6>
                                <p class="mb-1"><strong>Nombre:</strong> {{ $orden->user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $orden->user->email }}</p>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <h6 class="text-muted fw-bold text-uppercase small">Datos de la Orden</h6>
                                <p class="mb-1"><strong>Fecha:</strong> {{ $orden->obtenerFechaFormateada() }}</p>
                                <p class="mb-1"><strong>Estado:</strong> {!! $orden->obtenerBadgeEnvio() !!}</p>
                            </div>
                        </div>

                        <h6 class="text-muted fw-bold text-uppercase small text-start mb-2">Productos en la Orden</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-dark small">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center" style="width: 15%;">Cantidad</th>
                                        <th class="text-end" style="width: 20%;">Precio Unit.</th>
                                        <th class="text-end" style="width: 20%;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orden->items as $item)
                                        <tr>
                                            <td class="text-start">{{ $item->producto->nombre }}</td>
                                            <td class="text-center fw-bold">{{ $item->cantidad }}</td>
                                            <td class="text-end">${{ number_format($item->precio_unitario, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end text-dark fw-bold">
                                                ${{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="3" class="text-end">Monto Total:</td>
                                        <td class="text-end text-primary fs-5">{{ $orden->obtenerTotalMoneda() }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectores = document.querySelectorAll('.selector-estado');

            selectores.forEach(select => {
                let estadoAnterior = select.value;

                select.addEventListener('focus', function() {
                    estadoAnterior = this.value;
                });

                select.addEventListener('change', function() {
                    const ordenId = this.getAttribute('data-orden-id');
                    const nuevoEstado = this.value;

                    if (nuevoEstado === 'cancelada' || nuevoEstado === 'entregada') {
                        const mensaje =
                            `¿Estás seguro de marcar esta orden como ${nuevoEstado.toUpperCase()}? Esta acción NO se puede deshacer.`;

                        if (!confirm(mensaje)) {
                            this.value = estadoAnterior;
                            return;
                        }
                    }

                    select.disabled = true;

                    fetch(`/admin/ordenes/${ordenId}/actualizar-estado`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                estado: nuevoEstado
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Estado actualizado con éxito');

                                if (nuevoEstado === 'cancelada' || nuevoEstado ===
                                    'entregada') {
                                    select.disabled =
                                        true;
                                } else {
                                    select.disabled = false;
                                    estadoAnterior =
                                        nuevoEstado;
                                }
                            } else {
                                select.disabled = false;
                                this.value = estadoAnterior;
                                alert('Hubo un error al actualizar el estado en el servidor.');
                            }
                        })
                        .catch(error => {
                            select.disabled = false;
                            this.value = estadoAnterior;
                            console.error('Error:', error);
                            alert('No se pudo conectar con el servidor.');
                        });
                });
            });
        });
    </script>
@endsection
