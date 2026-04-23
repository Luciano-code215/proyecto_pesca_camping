<!DOCTYPE html>
<html>

<head>
    <title>Consultas</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
</head>

<body>
    @include('navbar')

    <style>
        body {
            background-image: url('{{ asset('img/fondo-contacto.png') }}');
            background-size: cover;
            background-position: center;
        }
    </style>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Contactanos</h4>
                    </div>
                    <div class="card-body">
                        <form action="/form-consultas" method="POST">
                            @csrf <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ej: Juan Pérez" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="nombre@ejemplo.com" required>
                            </div>

                

                            <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <div class="input-group">
                             <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" 
                                class="form-control" 
                                 id="celular" 
                                  name="celular"
                                     placeholder="Ej: 912345678" 
                                        inputmode="numeric" 
                                        pattern="[0-9]*"
                                         oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                             required>
                                                 </div>
                                                  </div>



                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Tu Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="¿En qué podemos ayudarte?"
                                    required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary text-white">Enviar Mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('mensaje_exito'))
        <div class="modal fade" id="mensajeGracias" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">¡Gracias por tu mensaje!</h5>
                    </div>
                    <div class="modal-body">
                        <p>Hola {{ session('nombre_usuario') }},</p>
                        <p>Un asesor se contactará a <strong>{{ session('email_usuario') }}</strong>.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            Entendido
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('mensajeGracias'));
                myModal.show();
            });
        </script>
    @endif

    @include('footer')

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
