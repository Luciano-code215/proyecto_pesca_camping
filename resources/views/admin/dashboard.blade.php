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
                    <h4 class="mb-0 fw-bold">{{ \App\Models\Producto::count() }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-danger border-4">
                <div class="fs-1 text-danger me-3"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Mensajes Contacto</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\Contacto::obtenerContactosPendientes()->count() }} nuevos</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-info border-4">
                <div class="fs-1 text-info me-3"><i class="bi bi-chat-left-text-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Consultas Clientes</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\Consulta::consultasPendientes()->count() }} nuevas</h4>
                </div>
            </div>
        </div>
    </div>



    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-dark border-4">
                <div class="fs-1 text-dark me-3"><i class="bi bi-calculator"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Ticket Promedio</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\Orden::obtenerEntregadas()->avg('total') }}</h4>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Monto estimado por compra</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-dark border-4">
                <div class="fs-1 text-dark me-3"><i class="bi bi-people-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Clientes Registrados</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\User::usuariosActivos()->count() }}</h4>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Usuarios con cuenta activa</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-dark border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3">
            <i class="bi bi-star-fill text-warning me-2"></i>Top {{ $topProductos->count() }} Productos Más Vendidos
        </h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 10%;">Puesto</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Unidades Vendidas</th>
                        <th>Total Recaudado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topProductos as $item)
                        <tr>
                            <td class="ps-3">
                                @if ($loop->iteration == 1)
                                    <span class="badge bg-warning text-dark fw-bold fs-6">#1</span>
                                @elseif($loop->iteration == 2)
                                    <span class="badge bg-secondary fw-bold fs-6">#2</span>
                                @else
                                    <span class="badge bg-danger fw-bold fs-6">#3</span>
                                @endif
                            </td>

                            <td class="fw-bold text-dark">
                                {{ $item->producto->nombre ?? 'Producto Eliminado' }}
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $item->producto->categoria->nombre ?? 'Sin Categoría' }}
                                </span>
                            </td>

                            <td>{{ $item->total_vendido }} unidades</td>

                            <td class="fw-semibold text-success">
                                ${{ number_format($item->total_recaudado, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                    @if ($topProductos->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No hay ventas registradas todavía.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-dark border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3">
            <i class="bi bi-star-fill text-warning me-2"></i>Ranking Categorías Más Vendidas
        </h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 10%;">Puesto</th>
                        <th>Categoría</th>
                        <th>Unidades Vendidas</th>
                        <th>Total Recaudado</th>
                    </tr>
                </thead>
                <tbody id="ranking-body">
                    @foreach ($topCategorias as $categoria)
                        <tr>
                            <td class="ps-3">
                                {{-- 🟢 Puestos Dinámicos con diseño condicional --}}
                                @if ($loop->iteration == 1)
                                    <span class="badge bg-warning text-dark fw-bold fs-6 shadow-sm"><i
                                            class="bi bi-trophy-fill me-1"></i>#1</span>
                                @elseif($loop->iteration == 2)
                                    <span class="badge bg-secondary text-white fw-bold fs-6 shadow-sm">#2</span>
                                @elseif($loop->iteration == 3)
                                    <span class="badge bg-danger text-white fw-bold fs-6 shadow-sm"
                                        style="background-color: #cd7f32 !important;">#3</span>
                                @else
                                    {{-- Del puesto 4 en adelante se genera el número automático gris clásico --}}
                                    <span
                                        class="badge bg-light text-dark border fw-semibold fs-6">#{{ $loop->iteration }}</span>
                                @endif
                            </td>

                            <td class="fw-bold text-dark">
                                {{ $categoria->nombre }}
                            </td>

                            <td>{{ $categoria->total_vendido ?? 0 }} unidades</td>

                            <td class="fw-semibold text-success">
                                ${{ number_format($categoria->total_recaudado ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                    @if ($topCategorias->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">No hay ventas registradas todavía.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
