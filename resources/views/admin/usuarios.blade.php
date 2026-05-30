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

                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="marcos@paranapesca.com">

                        @error('email')
                            <div class="invalid-feedback fw-bold">
                                <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contraseña</label>
                        <input type="password" name="password" minlength="8" id="password" class="form-control"
                            placeholder="••••••••">
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
                                                title="Cambiar mi contraseña" data-bs-toggle="modal"
                                                data-bs-target="#modalPassword">
                                                <i class="bi bi-pencil"></i> Cambiar Contraseña
                                            </button>
                                        @elseif($usuario->rol === 'admin')
                                            <form action="{{ url('/admin/usuarios/' . $usuario->id . '/baja-admin') }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Estás seguro de que deseas quitarle los permisos de administrador a {{ $usuario->name }}?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Dar de baja acceso">
                                                    <i class="bi bi-person-x-fill"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ url('/admin/usuarios/' . $usuario->id . '/alternar-estado') }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Estás seguro de que deseas alternar el estado de {{ $usuario->name }}?');">
                                                @csrf

                                                @if ($usuario->active)
                                                    <button type="submit" class="btn btn-sm btn-outline-warning text-dark"
                                                        title="Suspender cuenta">
                                                        <i class="bi bi-slash-circle"></i> Suspender
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-outline-success"
                                                        title="Reactivar cuenta">
                                                        <i class="bi bi-check-circle"></i> Reactivar
                                                    </button>
                                                @endif
                                            </form>
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

    {{-- Mensajes de errores o exito --}}

    @if (session('registrado'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            <div class="toast show align-items-center text-white bg-success border-0 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check fs-4"></i>
                        <div>
                            <strong>¡Registro Exitoso!</strong><br>
                            {{ session('registrado') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 60px;">

        @if (session('contraseña_actualizada'))
            <div class="alert alert-success alert-dismissible fade show fw-semibold shadow" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('contraseña_actualizada') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error_cambiar_password'))
            <div class="alert alert-danger alert-dismissible fade show fw-semibold shadow" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error_cambiar_password') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="alert alert-warning alert-dismissible fade show fw-semibold shadow" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $errors->first('password') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>

    @if (session('no_se_pudo_alternar_activo'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            <div class="toast show align-items-center text-white bg-danger border-0 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body d-flex align-items-center gap-2">
                        <i class="bi bi-shield-x fs-4"></i>
                        <div>
                            <strong>¡Error al Alternar Estado del Usuario!</strong><br>
                            {{ session('no_se_pudo_alternar_activo') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if (session('contraseña_actualizada'))
        <div class="alert alert-success alert-dismissible fade show fw-semibold" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('contraseña_actualizada') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error_cambiar_password'))
        <div class="alert alert-danger alert-dismissible fade show fw-semibold" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error_cambiar_password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->has('password'))
        <div class="alert alert-warning alert-dismissible fade show fw-semibold" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ $errors->first('password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalPasswordLabel"><i class="bi bi-lock-fill me-2"></i>Cambiar
                        Mi Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ url('/admin/usuarios/cambiar-password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-muted small">Por seguridad, asegúrate de ingresar una contraseña firme de al menos 8
                            caracteres.</p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Nueva Contraseña</label>
                            <input type="password" name="password" class="form-control" required
                                placeholder="Mínimo 8 caracteres">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Nueva
                                Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                placeholder="Repite la contraseña">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
