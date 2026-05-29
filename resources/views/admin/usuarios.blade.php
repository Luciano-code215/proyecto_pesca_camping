@extends('layouts.admin')

@section('titulo', 'Gestión de Usuarios')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-people-fill text-dark me-2"></i>Control de Usuarios y Roles</h3>
        <span class="text-muted">Administración del personal del sitio</span>
    </div>

    <div class="row g-4">

        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 border-top border-dark border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-2"><i class="bi bi-person-plus-fill text-success me-2"></i>Registrar Nuevo
                    Administrador</h5>
                <p class="text-muted small">Crea credenciales para que personal de confianza colabore con el control de la
                    tienda.</p>

                <form action="/crear-admin" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Ej: Marcos Maidana">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="marcos@paranapesca.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-danger"><i class="bi bi-shield-lock-fill me-1"></i>Rol
                            Asignado (Bloqueado)</label>
                        <select class="form-select border-danger" disabled
                            style="background-color: #f8f9fa; cursor: not-allowed;">
                            <option value="admin" selected>Administrador del Sistema</option>
                            <option value="comprador">Comprador / Cliente (Deshabilitado)</option>
                        </select>
                        <div class="form-text text-danger fw-bold small mt-1">
                            <i class="bi bi-exclamation-octagon-fill me-1"></i> Por seguridad, las cuentas de compradores se
                            generan únicamente desde el registro público de la tienda.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 fw-bold mt-2">
                        <i class="bi bi-person-check-fill me-1"></i> Crear Cuenta Admin
                    </button>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 border-top border-secondary border-3 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-person-lines-fill text-secondary me-2"></i>Usuarios
                    Registrados en el Sistema</h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Nombre</th>
                                <th>Email</th>
                                <th>Rol / Tipo</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="ps-3 fw-bold text-dark">
                                        {{ $usuario->name }}
                                        @if (auth()->check() && auth()->id() === $usuario->id)
                                            <span class="text-secondary font-monospace small">(Vos)</span>
                                        @endif
                                    </td>

                                    <td>{{ $usuario->email }}</td>

                                    <td>
                                        @if ($usuario->rol === 'admin')
                                            <span class="badge bg-dark"><i class="bi bi-shield-shaded me-1"></i>
                                                Admin</span>
                                        @else
                                            <span class="badge bg-light text-dark border"><i class="bi bi-cart me-1"></i>
                                                Comprador</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($usuario->active)
                                            <span
                                                class="badge bg-success-subtle text-success border border-success">Activo</span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger">Inactivo</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if (auth()->check() && auth()->id() === $usuario->id)
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                title="Editar datos" disabled>
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        @elseif($usuario->rol === 'admin')
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                title="Dar de baja acceso">
                                                <i class="bi bi-person-x-fill"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-warning text-dark"
                                                title="Suspender cuenta">
                                                <i class="bi bi-slash-circle"></i> Suspender
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-text mt-3 text-muted text-center">
                    <i class="bi bi-info-circle"></i> Las cuentas tipo <strong>Comprador</strong> se listan acá solo para
                    control e inactivación por parte del administrador en caso de fraudes.
                </div>
            </div>
        </div>

    </div>

    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check fs-4"></i>
                        <div>
                            <strong>¡Registro Exitoso!</strong><br>
                            {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
@endsection
