@extends('layouts.admin')

@section('titulo', 'Contactos Generales')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-envelope-fill text-danger me-2"></i>Mensajes de Contacto (Público General)
        </h3>
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
                                <span class="text-muted fw-normal text-truncate d-inline-block" style="max-width: 250px;">
                                    {{ $c->mensaje }}
                                </span>
                            </td>
                            <td>{{ $c->created_at->format('d/m/Y H:i A') }}</td>

                            <td class="text-center">
                                <button type="button"
                                    class="btn btn-sm {{ $c->estado == 'pendiente' ? 'btn-outline-danger' : 'btn-light border' }} px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalAtenderContacto"
                                    data-id="{{ $c->id }}" data-cliente="{{ $c->nombre }}"
                                    data-email="{{ $c->email }}" data-mensaje="{{ $c->mensaje }}"
                                    data-respuesta="{{ $c->respuesta ? $c->respuesta->respuesta : '' }}">

                                    @if ($c->estado == 'pendiente')
                                        <i class="bi bi-envelope-open-fill me-1"></i> Leer Mensaje
                                    @else
                                        <i class="bi bi-eye me-1"></i> Volver a Leer
                                    @endif
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalAtenderContacto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.contactos.responder') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" name="contacto_id" id="input-contacto-id">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Mensaje de <span id="span-cliente"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-secondary border-0 shadow-sm">
                        <h6><strong>Correo:</strong> <span id="text-email" class="text-danger"></span></h6>
                        <hr>
                        <p class="mb-1"><strong>Mensaje original:</strong></p>
                        <p id="text-mensaje" class="fst-italic text-dark mb-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="input-respuesta" class="form-label fw-bold">Escribe la respuesta por correo:</label>
                        <textarea class="form-control" name="respuesta" id="input-respuesta" rows="6"
                            placeholder="Escribe aquí los detalles que se le enviarán al remitente..." required></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" id="btn-enviar">
                        <i class="bi bi-send-fill me-1"></i> Registrar y Responder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalAtender = document.getElementById('modalAtenderContacto');

            if (modalAtender) {
                modalAtender.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Botón que disparó el evento

                    // Extraemos los atributos data-* del botón
                    const id = button.getAttribute('data-id');
                    const cliente = button.getAttribute('data-cliente');
                    const email = button.getAttribute('data-email');
                    const mensaje = button.getAttribute('data-mensaje');
                    const respuestaExistente = button.getAttribute('data-respuesta');

                    // Inyectamos los valores en los contenedores del modal
                    document.getElementById('input-contacto-id').value = id;
                    document.getElementById('span-cliente').textContent = cliente;
                    document.getElementById('text-email').textContent = email;
                    document.getElementById('text-mensaje').textContent = mensaje;

                    const textarea = document.getElementById('input-respuesta');
                    const btnEnviar = document.getElementById('btn-enviar');

                    // Si ya existe una respuesta cargada en la relación, bloqueamos el modal
                    if (respuestaExistente && respuestaExistente.trim() !== '') {
                        textarea.value = respuestaExistente;
                        textarea.readOnly = true;
                        btnEnviar.classList.add('d-none'); // Esconde el botón de enviar
                    } else {
                        textarea.value = '';
                        textarea.readOnly = false;
                        btnEnviar.classList.remove('d-none'); // Muestra el botón de enviar
                    }
                });
            }
        });
    </script>
@endsection
