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
                <h2 class="fw-bold mb-1">{{ \App\Models\Contacto::obtenerContactosPendientes()->count() }}</h2>
                <p class="mb-0 small">Emails entrantes sin revisar</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-success text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-archive-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Mensajes Respondidos</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Contacto::obtenerContactosRespondidos()->count() }}</h2>
                <p class="mb-0 small">Historial de consultas resueltas</p>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-danger border-3 p-4 bg-white">

        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-search text-secondary me-2"></i>Bandeja de Entrada General</h5>
        <div class="row g-2 align-items-center mb-4">
            <div class="col-sm-9">
                <form action="{{ route('admin.contactos') }}" method="GET">
                    <div class="input-group input-group-lg">

                        <input type="text" name="buscar" class="form-control"
                            placeholder="Buscar por nombre, correo electrónico o palabra clave"
                            value="{{ request('buscar') }}">

                        <button type="submit" class="btn btn-danger fw-bold px-4">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Nombre Remitente</th>
                            <th>Correo Electrónico</th>
                            <th>Mensaje Breve</th>
                            <th>Fecha</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactos as $c)
                            <tr
                                @if ($c->estado == 'pendiente') style="background-color: rgba(220, 53, 69, 0.02); border-left: 3px solid #dc3545;" class="fw-bold"
                    @else 
                        class="text-muted opacity-75" @endif>

                                <td class="ps-3 text-dark">{{ $c->nombre }}</td>
                                <td>{{ $c->email }}</td>
                                <td>
                                    <span class="text-muted fw-normal text-truncate d-inline-block"
                                        style="max-width: 250px;">
                                        {{ $c->mensaje }}
                                    </span>
                                </td>
                                <td>{{ $c->created_at->format('d/m/Y H:i A') }}</td>

                                <td class="text-center">
                                    @if ($c->estado == 'pendiente')
                                        <button type="button" class="btn btn-sm btn-outline-danger px-3"
                                            data-bs-toggle="modal" data-bs-target="#modalContacto{{ $c->id }}"
                                            title="Leer mensaje completo">
                                            <i class="bi bi-envelope-open-fill me-1"></i> Leer Mensaje
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-light border px-3"
                                            data-bs-toggle="modal" data-bs-target="#modalContacto{{ $c->id }}"
                                            title="Volver a leer">
                                            <i class="bi bi-eye me-1"></i> Volver a Leer
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="modalContacto{{ $c->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border-0 shadow">

                                        <div
                                            class="modal-header {{ $c->estado == 'pendiente' ? 'bg-dark text-white' : 'bg-light text-dark' }}">
                                            <h5 class="modal-title fw-bold">
                                                {{ $c->estado == 'pendiente' ? 'Nueva Consulta Pendiente' : 'Consulta Leída' }}
                                            </h5>
                                            <button type="button"
                                                class="btn-close {{ $c->estado == 'pendiente' ? 'btn-close-white' : '' }}"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body p-4" style="text-align: left;">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="text-muted small d-block">Remitente</label>
                                                    <strong class="text-dark">{{ $c->nombre }}</strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-muted small d-block">Correo de Contacto</label>
                                                    <strong class="text-primary">{{ $c->email }}</strong>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="text-muted small d-block">Asunto</label>
                                                <h6 class="fw-bold text-dark">{{ $c->asunto ?? 'Sin Asunto' }}</h6>
                                            </div>

                                            <div class="mb-4">
                                                <label class="text-muted small d-block mb-1">Mensaje de la Consulta</label>
                                                <div class="p-3 bg-light rounded border text-dark"
                                                    style="white-space: pre-line;">
                                                    {{ $c->mensaje }}
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="text-end">
                                                @if ($c->estado == 'pendiente')
                                                    <form action="{{ route('admin.contactos.leido', $c->id) }}"
                                                        method="POST" id="formLeido{{ $c->id }}"
                                                        class="d-inline mb-0">
                                                        @csrf
                                                        <button type="button" class="btn btn-secondary me-2"
                                                            data-bs-dismiss="modal">Cerrar</button>

                                                        <button type="button" class="btn btn-danger fw-bold btn-entendido"
                                                            data-email="{{ $c->email }}"
                                                            data-form="formLeido{{ $c->id }}"
                                                            data-modal="modalContacto{{ $c->id }}">
                                                            <i class="bi bi-check2-circle me-1"></i> Entendido
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="btn btn-secondary px-4"
                                                        data-bs-dismiss="modal">Cerrar Vista</button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const botonesEntendido = document.querySelectorAll('.btn-entendido');

                    botonesEntendido.forEach(boton => {
                        boton.addEventListener('click', function() {
                            const botonActual = this;
                            const email = botonActual.getAttribute('data-email');
                            const formId = botonActual.getAttribute('data-form');
                            const modalId = botonActual.getAttribute('data-modal');

                            const formulario = document.getElementById(formId);
                            const modalElement = document.getElementById(modalId);
                            const modalBody = modalElement.querySelector('.modal-body');

                            // 🛠️ INYECCIÓN INTERNA: Creamos el bloque de texto temporal DENTRO del modal
                            // para que Bootstrap no bloquee el portapapeles del sistema operativo.
                            const aux = document.createElement("textarea");
                            aux.value = email;
                            aux.style.position = "absolute";
                            aux.style.opacity = "0"; // Invisible
                            modalBody.appendChild(aux);

                            aux.select();
                            aux.setSelectionRange(0, 99999);

                            try {
                                // Copiamos el email
                                document.execCommand("copy");

                                // Feedback visual en el botón
                                botonActual.className = "btn btn-success fw-bold";
                                botonActual.innerHTML =
                                    '<i class="bi bi-clipboard-check-fill me-1"></i> ¡Copiado!';
                            } catch (err) {
                                console.error("No se pudo copiar", err);
                            }

                            // Limpiamos el elemento temporal
                            modalBody.removeChild(aux);

                            // Esperamos un instante para que veas el "¡Copiado!" en verde y envía el formulario
                            setTimeout(() => {
                                formulario.submit();
                            }, 400);
                        });
                    });
                });
            </script>
        </div>
    @endsection
