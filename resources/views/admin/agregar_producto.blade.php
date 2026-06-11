@extends('layouts.admin')

@section('titulo', 'Gestión de Productos')

@section('contenido')
    <div class="container-fluid px-4 py-3">

        @if (session('producto_creado'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3">
                <strong>{{ session('producto_creado') }}</strong>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-bold">
                    <i class="bi bi-box-seam-fill me-2 text-primary"></i>Nuevo Producto
                </h1>
                <p class="text-muted small mb-0">Carga un nuevo artículo al inventario del sistema.</p>
            </div>
            <a href="{{ url('/admin/productos') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Volver al Listado
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show fw-semibold shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Por favor, corrige los errores del formulario.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <form action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($producto))
                        @method('PUT')
                    @endif
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-semibold">Nombre del Producto</label>
                            <input type="text" name="nombre" id="nombre"
                                class="form-control @error('nombre') is-invalid @enderror"
                                value="{{ old('nombre', $producto->nombre ?? '') }}" placeholder="Ej: Caña Shimano 1.8Mts"
                                required>
                            @error('nombre')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="sku" class="form-label fw-semibold">SKU (Código de Producto)</label>
                            <input type="text" name="sku" id="sku"
                                class="form-control @error('sku') is-invalid @enderror"
                                value="{{ old('sku', $producto->sku ?? '') }}" placeholder="Ej: SHI-CAN-180 (Opcional)">
                            <div class="form-text text-muted">Déjalo en blanco para generar un código automático.</div>
                            @error('sku')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Categoría</label>
                            <select name="categoria_id" class="form-select" required>
                                <option value="" disabled {{ !isset($producto) ? 'selected' : '' }}>Selecciona una...
                                </option>

                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('categoria_id', $producto->categoria_id ?? '') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="precio" class="form-label fw-semibold">Precio de Venta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" name="precio" id="precio"
                                    class="form-control @error('precio') is-invalid @enderror"
                                    value="{{ old('precio', $producto->precio ?? '') }}" placeholder="0.00" required>
                            </div>
                            @error('precio')
                                <div class="text-danger small fw-bold mt-1 d-block"><i
                                        class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock" class="form-label fw-semibold">Stock Inicial</label>
                            <input type="number" name="stock" id="stock"
                                class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $producto->stock ?? '') }}" placeholder="1" min="1" required>
                            @error('stock')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label fw-semibold">Descripción del Producto</label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Detalles sobre ingredientes, tamaño, especificaciones... (Opcional)">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Imagen del Producto</label>
                            <input type="file" name="url_imagen" class="form-control">

                            @if (isset($producto) && $producto->url_imagen)
                                <div class="mt-3 p-2 border rounded d-inline-block bg-light">
                                    <small class="text-muted d-block mb-2 fw-semibold"><i class="bi bi-image me-1"></i>
                                        Imagen actual:</small>
                                    <img src="{{ asset($producto->url_imagen) }}" alt="Imagen de {{ $producto->nombre }}"
                                        style="width: 120px; height: 120px; object-fit: cover;" class="rounded shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="{{ url('/admin/productos') }}" class="btn btn-light fw-semibold">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4 fw-semibold">
                            <i class="bi bi-cloud-arrow-up-fill me-1"></i> Guardar Producto
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>


@endsection
