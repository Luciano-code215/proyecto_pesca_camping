@extends('layouts.admin')

@section('titulo', 'Administración de Productos')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam-fill text-warning me-2"></i>Catálogo de Productos</h3>
        <button type="button" class="btn btn-success fw-bold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Agregar Producto (Esqueleto)
        </button>
    </div>

    <div class="card shadow-sm border-0 p-3 mb-4 bg-white">
        <div class="row g-2">
            <div class="col-12 col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar por código o nombre...">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <select class="form-select">
                    <option value="" selected disabled>Filtrar por Categoría (Desplegable)</option>
                    <option value="todas">Todas las categorías</option>
                    <option value="cañas">Cañas de Pescar</option>
                    <option value="reeles">Reeles</option>
                    <option value="carpas">Carpas y Bolsas de Dormir</option>
                    <option value="indumentaria">Indumentaria y Calzado</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <button type="button" class="btn btn-outline-warning text-dark w-100 fw-bold">
                    <i class="bi bi-funnel-fill me-1"></i> Aplicar Filtro
                </button>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-warning border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-list-stars text-secondary me-2"></i>Artículos en Inventario</h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 8%;">Código</th>
                        <th style="width: 10%;">Miniatura</th>
                        <th>Nombre del Producto</th>
                        <th>Categoría</th>
                        <th>Precio Unitario</th>
                        <th>Stock Disponible</th>
                        <th class="text-center" style="width: 15%;">Acciones Estáticas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3 fw-bold text-secondary">#P-001</td>
                        <td>
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted"
                                style="width: 50px; height: 50px; font-size: 0.75rem;">
                                <i class="bi bi-image fs-5"></i>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Caña de Pescar Shimano Alivio 2.40mts</td>
                        <td><span class="badge bg-light text-dark border">Cañas</span></td>
                        <td class="fw-semibold text-dark">$45.500</td>
                        <td><span class="badge bg-success-subtle text-success border border-success fw-bold">12
                                unidades</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Editar"><i
                                    class="bi bi-pencil-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"><i
                                    class="bi bi-trash3-fill"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-secondary">#P-002</td>
                        <td>
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted"
                                style="width: 50px; height: 50px; font-size: 0.75rem;">
                                <i class="bi bi-image fs-5"></i>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Carpa Igloo Coleman 4 Personas Waterproof</td>
                        <td><span class="badge bg-light text-dark border">Carpas</span></td>
                        <td class="fw-semibold text-dark">$120.000</td>
                        <td><span class="badge bg-warning-subtle text-warning border border-warning fw-bold">2 unidades
                                (Crítico)</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Editar"><i
                                    class="bi bi-pencil-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"><i
                                    class="bi bi-trash3-fill"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-3 fw-bold text-secondary">#P-003</td>
                        <td>
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted"
                                style="width: 50px; height: 50px; font-size: 0.75rem;">
                                <i class="bi bi-image fs-5"></i>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Reel Frontal Spinit Albatros 4000</td>
                        <td><span class="badge bg-light text-dark border">Reeles</span></td>
                        <td class="fw-semibold text-dark">$32.500</td>
                        <td><span class="badge bg-danger-subtle text-danger border border-danger fw-bold">0 unidades
                                (Agotado)</span></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" title="Editar"><i
                                    class="bi bi-pencil-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"><i
                                    class="bi bi-trash3-fill"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-text mt-3 text-center text-muted">
            <i class="bi bi-info-circle-fill text-warning me-1"></i> Nota de maquetación: Los colores de las etiquetas de
            stock cambian según la cantidad disponible. Al conectar tu controlador, usarás directivas de Blade para evaluar
            si el número es cero y pintar la alerta correspondiente.
        </div>
    </div>
@endsection
