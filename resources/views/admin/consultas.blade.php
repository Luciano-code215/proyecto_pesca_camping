@extends('layouts.admin')

@section('titulo', 'Consultas de Clientes')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="bi bi-chat-left-text-fill text-primary me-2"></i>Consultas de Clientes (Logueados)
        </h3>
        <span class="text-muted">Interacciones con usuarios registrados del sitio</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-primary text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Total Consultas</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Consulta::count() }}</h2>
                <p class="mb-0 small">Historial acumulado de preguntas</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-danger text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Sin Responder</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Consulta::consultasPendientes()->count() }}</h2>
                <p class="mb-0 small">Mensajes críticos que esperan feedback</p>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card bg-info text-white p-3 shadow-sm border-0 position-relative overflow-hidden">
                <div class="position-absolute end-0 bottom-0 opacity-25 me-2" style="font-size: 4rem;">
                    <i class="bi bi-check-all"></i>
                </div>
                <h6 class="text-uppercase fw-bold small">Respondidas</h6>
                <h2 class="fw-bold mb-1">{{ \App\Models\Consulta::consultasRespondidas()->count() }}</h2>
                <p class="mb-0 small">Consultas atendidas correctamente</p>
            </div>
        </div>
    </div>

    @if (session('respuesta_guardada'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center mb-4"
            role="alert">
            <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
            <div>
                <strong class="d-block text-success fw-bold">¡Consulta Procesada!</strong>
                {{ session('respuesta_guardada') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 border-top border-primary border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-funnel text-secondary me-2"></i>Bandeja de Entrada</h5>

        <div class="row g-2 align-items-center mb-4">
            <div class="col-sm-8">
                <select class="form-select border-primary" id="filtro-estado"
                    onchange="window.location.href = `{{ route('admin.consultas') }}?estado=${this.value}`">
                    <option value="todos" {{ request('estado') == 'todos' || !request('estado') ? 'selected' : '' }}>
                        Mostrar todas las consultas de la cuenta</option>
                    <option value="pendientes" {{ request('estado') == 'pendientes' ? 'selected' : '' }}>Ver solo las
                        Pendientes</option>
                    <option value="respondidas" {{ request('estado') == 'respondidas' ? 'selected' : '' }}>Ver solo las
                        Respondidas</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">ID Usuario</th>
                        <th>Cliente Logueado</th>
                        <th>Producto / Motivo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consultas as $consulta)
                        <tr class="{{ $consulta->estado === 'pendiente' ? 'table-warning-light' : '' }}"
                            style="{{ $consulta->estado === 'pendiente' ? 'background-color: rgba(255, 193, 7, 0.05);' : '' }}">

                            <td class="ps-3 fw-bold">#USR-{{ str_pad($consulta->user_id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $consulta->user->name ?? 'Usuario Eliminado' }}</td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                    {{ $consulta->asunto }}
                                </span>
                            </td>
                            <td>{{ $consulta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $consulta->estado === 'pendiente' ? 'bg-danger' : 'bg-success' }}">
                                    <i
                                        class="bi {{ $consulta->estado === 'pendiente' ? 'bi-envelope-fill' : 'bi-check-circle' }} me-1"></i>
                                    {{ ucfirst($consulta->estado) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @php
                                    $respuestaRegistro = \App\Models\Respuesta_consulta::buscarPorConsultaId(
                                        $consulta->id,
                                    );
                                @endphp

                                <button type="button"
                                    class="btn btn-sm {{ $consulta->estado === 'respondida' ? 'btn-secondary' : 'btn-primary' }}"
                                    data-bs-toggle="modal" data-bs-target="#modalRespuesta" data-id="{{ $consulta->id }}"
                                    data-asunto="{{ $consulta->asunto }}" data-mensaje="{{ $consulta->mensaje }}"
                                    data-estado="{{ $consulta->estado }}"
                                    data-respuesta="{{ $respuestaRegistro ? $respuestaRegistro->respuesta : '' }}">

                                    <i
                                        class="bi {{ $consulta->estado === 'respondida' ? 'bi-eye-fill' : 'bi-reply-fill' }}"></i>
                                    {{ $consulta->estado === 'respondida' ? 'Ver Respuesta' : 'Responder' }}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-text mt-3 text-center text-muted">
            <i class="bi bi-shield-lock-fill text-info me-1"></i> <strong>Nota de Seguridad:</strong> Este módulo asume que
            los usuarios iniciaron sesión. Al vincular tu Base de Datos, podrás relacionar la tabla de `consultas` con tu
            tabla de `users` a través de la clave foránea `user_id`.
        </div>
    </div>

    <div class="modal fade" id="modalRespuesta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.consultas.responder') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" name="consulta_id" id="modal-consulta-id">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title"><i class="bi bi-reply-all-fill me-2"></i>Procesar Consulta de Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-secondary border-0 shadow-sm">
                        <h6><strong>Asunto o Motivo:</strong> <span id="modal-asunto" class="fw-bold"></span></h6>
                        <hr class="my-2">
                        <p class="mb-1 fw-bold text-muted">Mensaje original:</p>
                        <p id="modal-mensaje" class="fst-italic text-dark mb-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="textarea-respuesta" class="form-label fw-bold">Escribe la respuesta:</label>
                        <textarea class="form-control" name="respuesta" id="textarea-respuesta" rows="6"
                            placeholder="Escribe aquí los detalles que el usuario verá en su panel..." required></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btn-guardar-respuesta">
                        <i class="bi bi-send-fill me-1"></i> Guardar y Notificar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalRespuesta = document.getElementById('modalRespuesta');
            if (modalRespuesta) {
                modalRespuesta.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    // Extracción de atributos de datos
                    const id = button.getAttribute('data-id');
                    const asunto = button.getAttribute('data-asunto');
                    const mensaje = button.getAttribute('data-mensaje');
                    const estado = button.getAttribute('data-estado');
                    const respuesta = button.getAttribute('data-respuesta');

                    // Llenado de los campos del modal
                    document.getElementById('modal-consulta-id').value = id;
                    document.getElementById('modal-asunto').textContent = asunto;
                    document.getElementById('modal-mensaje').textContent = mensaje;

                    const textareaRespuesta = document.getElementById('textarea-respuesta');
                    const btnGuardar = document.getElementById('btn-guardar-respuesta');

                    // 🛑 Validación basada en tu lógica de estado 'respondida'
                    if (estado === 'respondida') {
                        textareaRespuesta.value = respuesta;
                        textareaRespuesta.readOnly = true; // Bloquea la edición
                        btnGuardar.style.display = 'none'; // Desaparece el botón de enviar
                    } else {
                        textareaRespuesta.value = '';
                        textareaRespuesta.readOnly = false; // Habilita la escritura
                        btnGuardar.style.display = 'block'; // Muestra el botón de enviar
                    }
                });
            }
        });
    </script>
@endsection
