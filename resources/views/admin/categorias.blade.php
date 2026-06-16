@extends('layouts.admin')

@section('titulo', 'Gestión de Categorías')

@section('contenido')
    <div class="row g-3 mb-4">
        @php
            $colores = [
                'bg-primary',
                'bg-success',
                'bg-warning text-dark',
                'bg-danger',
                'bg-info text-dark',
                'bg-secondary',
            ];
        @endphp

        @foreach ($categorias as $categoria)
            @if ($categoria->activo)
                @php
                    $colorActual = $colores[$loop->iteration % count($colores)];
                @endphp

                <div class="col-12 col-md-4">
                    <div class="card {{ $colorActual }} p-3 shadow-sm border-0 position-relative overflow-hidden h-100">
                        <div class="position-absolute end-0 bottom-0 opacity-25 me-2"
                            style="font-size: 4rem; line-height: 1;">
                            <i class="bi bi-fish"></i>
                        </div>

                        <h6
                            class="text-uppercase fw-bold small {{ str_contains($colorActual, 'text-dark') ? 'text-black-50' : 'text-white-50' }}">
                            Rubro {{ $categoria->nombre }}
                        </h6>
                        <h2 class="fw-bold mb-0 mt-2">
                            {{ \App\Models\Producto::contarPorCategoria($categoria->id) }}
                        </h2>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    @if (session('categoria_creada'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> {{ session('categoria_creada') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('categoria_desactivada'))
        <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-eye-slash-fill me-2 text-warning"></i> {{ session('categoria_desactivada') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('categoria_reactivada'))
        <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-eye-fill me-2 text-info"></i> {{ session('categoria_reactivada') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 border-top border-info border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-plus-circle me-2 text-success"></i>Nueva Categoría
                </h5>

                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre_categoria" class="form-label fw-semibold">Nombre de la Categoría</label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            id="nombre_categoria" placeholder="Ej: Señuelos, Linternas, Cuchillos"
                            value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-info text-white w-100 fw-bold">
                        <i class="bi bi-disk me-1"></i> Guardar Categoría
                    </button>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 border-top border-secondary border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-tags-fill text-secondary me-2"></i>Categorías Registradas
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%">ID</th>
                                <th style="width: 50%">Nombre</th>
                                <th style="width: 20%" class="text-center">Estado</th>
                                <th style="width: 20%" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $cat)
                                <tr class="{{ !$cat->activo ? 'table-light opacity-75' : '' }}">
                                    <td class="fw-bold text-muted">#{{ $cat->id }}</td>
                                    <td
                                        class="fw-semibold {{ !$cat->activo ? 'text-muted text-decoration-line-through' : 'text-dark' }}">
                                        {{ $cat->nombre }}
                                    </td>
                                    <td class="text-center">
                                        @if ($cat->activo)
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5">Visible</span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5">Oculta</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-1">

                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#modalEditar{{ $cat->id }}"
                                                title="Modificar Nombre">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>

                                            @if ($cat->activo)
                                                <form action="{{ route('categorias.desactivar', $cat->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Ocultar Categoría">
                                                        <i class="bi bi-eye-slash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('categorias.reactivar', $cat->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        title="Hacer Visible">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalEditar{{ $cat->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-light border-bottom-0">
                                                <h5 class="modal-title fw-bold text-dark"><i
                                                        class="bi bi-pencil-square text-secondary me-2"></i>Editar Categoría
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('categorias.update', $cat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body py-3">
                                                    <label class="form-label fw-semibold">Nombre de la Categoría</label>
                                                    <input type="text" name="nombre" class="form-control"
                                                        value="{{ $cat->nombre }}" required>
                                                </div>
                                                <div class="modal-footer bg-light border-top-0">
                                                    <button type="button" class="btn btn-sm btn-secondary fw-semibold"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-info text-white fw-bold">Guardar
                                                        Cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                        No hay categorías creadas todavía.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
