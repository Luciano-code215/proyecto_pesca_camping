<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Consultas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    @include('navbar')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-chat-left-text-fill text-primary me-2"></i>Mis Consultas
                </h3>
                <p class="text-muted mb-0">Historial de soporte y preguntas de tu cuenta</p>
            </div>
            <a href="{{ route('form.consultas') }}" class="btn btn-primary fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Nueva Consulta
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-12 col-md-4">
                <label for="filtro-estado" class="form-label small fw-bold text-secondary">Filtrar por estado:</label>
                <select class="form-select border-primary shadow-sm" id="filtro-estado"
                    onchange="window.location.href = `{{ route('mis.consultas') }}?estado=${this.value}`">
                    <option value="todos" {{ request('estado') == 'todos' || !request('estado') ? 'selected' : '' }}>
                        Mostrar todas las consultas</option>
                    <option value="pendientes" {{ request('estado') == 'pendientes' ? 'selected' : '' }}>Ver solo
                        Pendientes</option>
                    <option value="respondidas" {{ request('estado') == 'respondidas' ? 'selected' : '' }}>Ver solo
                        Respondidas</option>
                </select>
            </div>
        </div>

        <div class="row g-3">
            @forelse ($consultas as $consulta)
                <div class="col-12">
                    <div
                        class="card shadow-sm border-0 border-start border-4 {{ $consulta->estado == 'pendiente' ? 'border-warning' : 'border-success' }} bg-white p-3">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <h5 class="fw-bold text-dark mb-1">{{ $consulta->asunto ?? 'Consulta General' }}</h5>
                                <span class="text-muted small">
                                    <i class="bi bi-calendar3 me-1"></i> Enviado el:
                                    {{ $consulta->created_at->format('d/m/Y H:i A') }}
                                </span>
                            </div>

                            @if ($consulta->estado == 'pendiente')
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                    <i class="bi bi-clock-history me-1"></i> Pendiente
                                </span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill fw-bold">
                                    <i class="bi bi-check-circle-fill me-1"></i> Respondida
                                </span>
                            @endif
                        </div>

                        <hr class="text-muted opacity-25 my-3">

                        <div class="mb-2">
                            <strong class="text-secondary small d-block mb-1">Mi mensaje:</strong>
                            <p class="text-dark mb-0 fst-italic bg-light p-2 rounded" style="white-space: pre-wrap;">
                                {{ $consulta->mensaje }}</p>
                        </div>

                        @if ($consulta->estado !== 'pendiente' && !empty($consulta->respuesta))
                            <div
                                class="mt-3 bg-success bg-opacity-10 border border-success border-opacity-25 p-3 rounded">
                                <strong class="text-success small d-block mb-1">
                                    <i class="bi bi-reply-fill me-1"></i> Respuesta del Soporte:
                                </strong>
                                <p class="text-dark mb-0 fw-normal" style="white-space: pre-wrap;">
                                    {{ $consulta->respuesta->respuesta }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card text-center p-5 border-0 shadow-sm bg-white">
                        <div class="text-muted mb-3" style="font-size: 3rem;">
                            <i class="bi bi-chat-square-dots"></i>
                        </div>
                        <h5 class="fw-bold text-secondary">No encontramos consultas</h5>
                        <p class="text-muted mb-0">No registrás ninguna consulta bajo el filtro seleccionado.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
