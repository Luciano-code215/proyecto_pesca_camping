@extends('layouts.admin')

@section('titulo', 'Administración de Productos')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam-fill text-warning me-2"></i>Catálogo de Productos</h3>
        <a href="{{ url('/admin/agregar_producto') }}" class="btn btn-success fw-bold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Agregar Producto
        </a>
    </div>

    @if (session('producto_actualizado'))
        <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4"
            role="alert">
            <i class="bi bi-pencil-square fs-4 me-3 text-info"></i>
            <div>
                <span class="fw-bold">Producto Actualizado:</span> {{ session('producto_actualizado') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('producto_eliminado'))
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4"
            role="alert">
            <i class="bi bi-trash3-fill fs-4 me-3 text-warning"></i>
            <div>
                <span class="fw-bold">Producto Desactivado:</span> {{ session('producto_eliminado') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('producto_reactivado'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4"
            role="alert">
            <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
            <div>
                <span class="fw-bold">¡Éxito!</span> {{ session('producto_reactivado') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 p-3 mb-4 bg-white">
        <div class="row g-3">

            <div class="col-12 col-md-4">
                <form action="{{ route('productos.index') }}" method="GET">
                    @if (request('categoria_id'))
                        <input type="hidden" name="categoria_id" value="{{ request('categoria_id') }}">
                    @endif
                    @if (request('estado'))
                        <input type="hidden" name="estado" value="{{ request('estado') }}">
                    @endif

                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar..."
                            value="{{ request('buscar') }}">
                    </div>
                </form>
            </div>

            <div class="col-12 col-md-4">
                <form action="{{ route('productos.index') }}" method="GET">
                    @if (request('buscar'))
                        <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                    @endif
                    @if (request('estado'))
                        <input type="hidden" name="estado" value="{{ request('estado') }}">
                    @endif

                    <select name="categoria_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="col-12 col-md-4">
                <form action="{{ route('productos.index') }}" method="GET">
                    @if (request('buscar'))
                        <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                    @endif
                    @if (request('categoria_id'))
                        <input type="hidden" name="categoria_id" value="{{ request('categoria_id') }}">
                    @endif

                    <select name="estado" class="form-select border-warning" onchange="this.form.submit()">
                        <option value="activos"
                            {{ request('estado') == 'activos' || !request('estado') ? 'selected' : '' }}>Ver: Productos
                            Activos</option>
                        <option value="inactivos" {{ request('estado') == 'inactivos' ? 'selected' : '' }}>Ver: Inactivos
                            (Papelera)</option>
                        <option value="todos" {{ request('estado') == 'todos' ? 'selected' : '' }}>Ver: Todos los
                            registros</option>
                    </select>
                </form>
            </div>

        </div>
        <div class="card shadow-sm border-0 border-top border-warning border-3 p-4 bg-white">
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-list-stars text-secondary me-2"></i>Artículos en Inventario
            </h5>

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
                            <th class="text-center" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                            <tr>
                                <td class="ps-3 fw-bold text-secondary">{{ $producto->sku }}</td>
                                <td>
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted"
                                        style="width: 50px; height: 50px; font-size: 0.75rem; overflow: hidden;">
                                        @if ($producto->url_imagen)
                                            <img src="{{ asset($producto->url_imagen) }}"
                                                alt="Miniatura de {{ $producto->nombre }}" class="w-100 h-100"
                                                style="object-fit: cover;">
                                        @else
                                            <i class="bi bi-image" style="font-size: 1.2rem;"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="fw-bold text-dark">{{ $producto->nombre }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        @if ($cat = \App\Models\Categoria::buscar($producto->categoria_id))
                                            {{ $cat->nombre }}
                                        @else
                                            Sin categoría
                                        @endif
                                    </span>
                                </td>

                                <td class="fw-semibold text-dark">${{ number_format($producto->precio, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($producto->stock == 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger fw-bold">Sin
                                            Stock</span>
                                    @elseif($producto->stock <= 5)
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning fw-bold">{{ $producto->stock }}
                                            últimas</span>
                                    @else
                                        <span
                                            class="badge bg-success-subtle text-success border border-success fw-bold">{{ $producto->stock }}
                                            unidades</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($producto->activo)
                                        <a href="{{ route('productos.edit', $producto->id) }}"
                                            class="btn btn-sm btn-outline-primary me-1" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de desactivar este producto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                title="Inactivar">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('productos.restore', $producto->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success fw-bold px-3"
                                                title="Reactivar">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reactivar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-emoji-frown fs-4 d-block mb-2 text-warning"></i>
                                    No se encontraron productos que coincidan con la búsqueda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
