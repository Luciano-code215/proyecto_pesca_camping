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

                <form action="#" method="GET" onsubmit="return false;">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre Completo</label>
                        <input type="text" class="form-control" placeholder="Ej: Marcos Maidana">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="marcos@paranapesca.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contraseña Temporal</label>
                        <input type="password" class="form-control" placeholder="••••••••">
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

                    <button type="button" class="btn btn-dark w-100 fw-bold mt-2">
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
                            <tr>
                                <td class="ps-3 fw-bold text-dark">Luciano (Vos)</td>
                                <td>luciano@admin.com</td>
                                <td><span class="badge bg-dark"><i class="bi bi-shield-shaded me-1"></i> Admin</span></td>
                                <td class="text-center"><span
                                        class="badge bg-success-subtle text-success border border-success">Activo</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" title="Editar datos"
                                        disabled><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3 fw-bold text-dark">Marisa Gómez</td>
                                <td>marisa_ventas@gmail.com</td>
                                <td><span class="badge bg-dark"><i class="bi bi-shield-shaded me-1"></i> Admin</span></td>
                                <td class="text-center"><span
                                        class="badge bg-success-subtle text-success border border-success">Activo</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        title="Dar de baja acceso"><i class="bi bi-person-x-fill"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3 text-secondary">Esteban Quito</td>
                                <td class="text-muted">esteban_pesca@hotmail.com</td>
                                <td><span class="badge bg-light text-dark border"><i class="bi bi-cart me-1"></i>
                                        Comprador</span></td>
                                <td class="text-center"><span
                                        class="badge bg-success-subtle text-success border border-success">Activo</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-warning text-dark"
                                        title="Suspender cuenta por mal comportamiento"><i class="bi bi-slash-circle"></i>
                                        Suspender</button>
                                </td>
                            </tr>
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
@endsection
