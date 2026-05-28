@extends('layouts.admin')

@section('titulo', 'Gestión de Categorías')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-tags-fill text-info me-2"></i>Módulo de Categorías</h3>
        <span class="text-muted">Organización del catálogo de Pesca y Camping</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card bg-primary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-fish"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Rubro Pesca</h6>
                <h2 class="fw-bold mb-1">84</h2>
                <p class="mb-0 small">Productos maquetados (Cañas, Reeles)</p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card bg-success text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-tent"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Rubro Camping</h6>
                <h2 class="fw-bold mb-1">45</h2>
                <p class="mb-0 small">Productos maquetados (Carpas, Bolsas)</p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card bg-warning text-dark p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-tsunami"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Rubro Náutica / Otros</h6>
                <h2 class="fw-bold mb-1">13</h2>
                <p class="mb-0 small">Productos maquetados (Botes, Salvavidas)</p>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 border-top border-info border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-plus-circle me-2 text-success"></i>Nueva Categoría</h5>

                <form action="#" method="GET" onsubmit="return false;">

                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label fw-semibold">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="nombre_categoria"
                            placeholder="Ej: Señuelos, Linternas, Cuchillos">
                    </div>

                    <div class="mb-3">
                        <label for="categoria_padre" class="form-label fw-semibold">Clasificación General</label>
                        <select class="form-select" id="categoria_padre">
                            <option value="" selected disabled>-- Selecciona el rubro principal --</option>
                            <option value="pesca">Pesca Deportiva</option>
                            <option value="camping">Camping y Aventura</option>
                            <option value="nautica">Náutica</option>
                        </select>
                        <div class="form-text">Estructura para agrupar subcategorías en el futuro.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold d-block">Estado Inicial</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="activo" value="1"
                                checked>
                            <label class="form-check-label text-success fw-bold">Visible en la Tienda</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="inactivo" value="0">
                            <label class="form-check-label text-danger fw-bold">Oculta por ahora</label>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info text-white w-100 fw-bold mt-2">
                        <i class="bi bi-disk me-1"></i> Guardar Categoría (Esqueleto)
                    </button>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 border-top border-secondary border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-2"><i class="bi bi-funnel-fill text-secondary me-2"></i>Filtro de Control
                    Rápido</h5>
                <p class="text-muted small">Estructura visual para filtrar los datos que se listen abajo.</p>

                <div class="row g-2 align-items-center mb-4">
                    <div class="col-sm-8">
                        <select class="form-select border-primary">
                            <option value="todos">Mostrar todas las categorías activas</option>
                            <option value="1">Solo Categorías de Pesca</option>
                            <option value="2">Solo Categorías de Camping</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-outline-primary w-100"><i class="bi bi-search"></i>
                            Filtrar</button>
                    </div>
                </div>

                <div class="p-4 bg-light rounded text-center border border-dashed py-5">
                    <i class="bi bi-table fs-1 text-muted d-block mb-2"></i>
                    <h6 class="fw-bold text-secondary">Contenedor de Listado General</h6>
                    <p class="text-muted small mb-0 px-4">
                        Este espacio queda reservado para tu etiqueta `
                    <table>`. Cuando asocies tu Base de Datos, acá adentro vas a meter el bucle que muestre los nombres
                        creados junto a sus botones de Editar y Eliminar.
                        </p>
                </div>
            </div>
        </div>

    </div>
@endsection
