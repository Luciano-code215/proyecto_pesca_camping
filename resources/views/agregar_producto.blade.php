<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body class="bg-light">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-3">
                    <a href="#" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver al listado
                    </a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0"><i class="bi bi-box-seam me-2"></i> Registrar Nuevo Producto</h5>
                    </div>

                    <div class="card-body p-4">

                        <form action="/agregar_producto" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Ej: Caña de Pescar Shimano" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                                    <select class="form-select" id="categoria_id" name="categoria_id" required>
                                        <option value="" selected disabled>Selecciona una categoría</option>
                                        <option value="1">Cañas</option>
                                        <option value="2">Reeles</option>
                                        <option value="3">Indumentaria</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="sku" class="form-label fw-bold">Código / SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku"
                                        placeholder="Ej: PROD-001">
                                </div>

                                <div class="col-md-6">
                                    <label for="precio" class="form-label fw-bold">Precio ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control" id="precio"
                                            name="precio" placeholder="0.00" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="stock" class="form-label fw-bold">Stock Disponible</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        placeholder="Ej: 10" min="0" required>
                                </div>

                                <div class="col-12">
                                    <label for="descripcion" class="form-label fw-bold">Descripción del Producto</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                        placeholder="Detalla las características del producto..."></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="url_imagen" class="form-label fw-bold">Imagen del Producto</label>
                                    <input type="file" class="form-control" id="url_imagen" name="url_imagen"
                                        accept="image/*">
                                    <div class="form-text">Formatos permitidos: JPG, PNG o WEBP. Máximo 2MB.</div>
                                </div>
                            </div>

                            <hr class="my-4 text-muted">

                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light border">Limpiar</button>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-disk me-1"></i> Guardar Producto
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
