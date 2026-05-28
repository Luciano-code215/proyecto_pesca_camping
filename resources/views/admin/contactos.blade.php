@extends('layouts.admin')

@section('titulo', 'Contactos Generales')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-envelope-fill text-danger me-2"></i>Mensajes de Contacto (Público
            General)</h3>
        <span class="text-muted">Correos recibidos desde el formulario de la web pública</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-danger text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-mailbox2"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Mensajes Nuevos</h6>
                <h2 class="fw-bold mb-1">4</h2>
                <p class="mb-0 small">Emails entrantes sin revisar</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-secondary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-archive-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Mensajes Archivados</h6>
                <h2 class="fw-bold mb-1">150</h2>
                <p class="mb-0 small">Historial de consultas resueltas</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-dark text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-trash3-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Spam / Descartados</h6>
                <h2 class="fw-bold mb-1">12</h2>
                <p class="mb-0 small">Correos publicitarios filtrados</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-danger border-3 p-4 bg-white">

        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-search text-secondary me-2"></i>Bandeja de Entrada General</h5>
        <div class="row g-2 align-items-center mb-4">
            <div class="col-sm-9">
                <input type="text" class="form-control"
                    placeholder="Buscar por nombre, correo electrónico o palabra clave (Esqueleto)...">
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-danger w-100 fw-bold"><i class="bi bi-search"></i> Buscar</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Nombre Remitente</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono / Celular</th>
                        <th>Mensaje Breve</th>
                        <th>Fecha</th>
                        <th class="text-center">Acciones Estáticas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="fw-bold" style="background-color: rgba(220, 53, 69, 0.02); border-left: 3px solid #dc3545;">
                        <td class="ps-3 text-dark">Carlos Gutiérrez</td>
                        <td>carlos.guti@gmail.com</td>
                        <td>3794-112233</td>
                        <td><span class="text-muted fw-normal text-truncate d-inline-block" style="max-width: 250px;">Hola,
                                quería saber si tienen stock de carpas estructurales para 6 personas y si hacen precio por
                                cantidad...</span></td>
                        <td>Hoy, 08:30 AM</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger me-1"
                                title="Leer mensaje completo"><i class="bi bi-envelope-open-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Archivar"><i
                                    class="bi bi-archive"></i></button>
                        </td>
                    </tr>
                    <tr class="fw-bold" style="background-color: rgba(220, 53, 69, 0.02); border-left: 3px solid #dc3545;">
                        <td class="ps-3 text-dark">Martín Basualdo</td>
                        <td>m_basualdo@outlook.com</td>
                        <td>-- Sin Teléfono --</td>
                        <td><span class="text-muted fw-normal text-truncate d-inline-block"
                                style="max-width: 250px;">Buenas, soy distribuidor de plomadas y anzuelos artesanales. Me
                                gustaría dejarles un catálogo de productos...</span></td>
                        <td>Ayer, 18:12 PM</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger me-1"
                                title="Leer mensaje completo"><i class="bi bi-envelope-open-fill"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Archivar"><i
                                    class="bi bi-archive"></i></button>
                        </td>
                    </tr>
                    <tr class="text-muted opacity-75">
                        <td class="ps-3">Estela Maris Benítez</td>
                        <td>estela_maris@yahoo.com</td>
                        <td>3794-556677</td>
                        <td><span class="text-truncate d-inline-block" style="max-width: 250px;">¿Qué horarios de atención
                                tienen en el local esta semana santa? Gracias.</span></td>
                        <td>22/05/2026</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-light me-1" title="Volver a leer"><i
                                    class="bi bi-eye"></i></button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Archivar"><i
                                    class="bi bi-archive"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-text mt-3 text-center text-muted">
            <i class="bi bi-info-circle-fill text-danger me-1"></i> <strong>Estructura Diferenciada:</strong> A diferencia
            de las consultas internas, estos datos no están vinculados a un ID de usuario. En tu base de datos, esta tabla
            (`contactos`) guardará los strings de texto puros de correo y teléfono para que les puedas responder por fuera
            de la plataforma.
        </div>

    </div>
@endsection
