@extends('layouts.admin')

@section('titulo', 'Informes y Estadísticas')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-graph-up-arrow text-dark me-2"></i>Panel de Estadísticas e Informes
        </h3>
        <span class="text-muted">Análisis de rendimiento comercial del sitio</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-dark border-4">
                <div class="fs-1 text-dark me-3"><i class="bi bi-calculator"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Ticket Promedio</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\Orden::obtenerEntregadas()->avg('total') }}</h4>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Monto estimado por compra</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-dark border-4">
                <div class="fs-1 text-dark me-3"><i class="bi bi-people-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Clientes Registrados</h6>
                    <h4 class="mb-0 fw-bold">{{ \App\Models\User::usuariosActivos()->count() }}</h4>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Usuarios con cuenta activa</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div
                class="card bg-white p-3 shadow-sm d-flex flex-row align-items-center border-0 border-start border-dark border-4">
                <div class="fs-1 text-dark me-3"><i class="bi bi-percent"></i></div>
                <div>
                    <h6 class="text-muted mb-1 small fw-bold">Conversión de Visitas</h6>
                    <h4 class="mb-0 fw-bold">3.5%</h4>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">Visitas que terminan en compra</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 p-4 bg-white h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-bar-chart-line-fill text-primary me-2"></i>Evolución de
                    Ventas Mensuales</h5>

                <div class="d-flex align-items-end justify-content-between pt-4 px-2 border-bottom" style="height: 200px;">
                    <div class="bg-primary opacity-50 rounded-top" style="height: 30%; width: 6%;" title="Ene: $45k"></div>
                    <div class="bg-primary opacity-50 rounded-top" style="height: 45%; width: 6%;" title="Feb: $60k"></div>
                    <div class="bg-primary opacity-50 rounded-top" style="height: 35%; width: 6%;" title="Mar: $50k"></div>
                    <div class="bg-primary opacity-75 rounded-top" style="height: 60%; width: 6%;" title="Abr: $85k"></div>
                    <div class="bg-primary rounded-top" style="height: 85%; width: 6%;" title="May (Actual): $120k"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Jun"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Jul"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Ago"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Sep"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Oct"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Nov"></div>
                    <div class="bg-light border rounded-top" style="height: 10%; width: 6%;" title="Dic"></div>
                </div>
                <div class="d-flex justify-content-between text-muted small mt-2 px-1">
                    <span>Ene</span><span>Feb</span><span>Mar</span><span>Abr</span><span
                        class="fw-bold text-primary">May</span><span>Jun</span><span>Jul</span><span>Ago</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dic</span>
                </div>
                <span class="form-text text-center d-block mt-3 text-muted">Esqueleto visual. Más adelante podrás integrar
                    librerías como <strong>Chart.js</strong> para renderizar gráficos reales.</span>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 p-4 bg-white h-100">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-pie-chart-fill text-success me-2"></i>Ventas por Rubro
                </h5>

                <div class="mt-3">
                    <div class="d-flex justify-content-between mb-1 small fw-semibold">
                        <span>Pesca Deportiva (55%)</span>
                        <span class="text-primary">$187.275</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: 55%"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1 small fw-semibold">
                        <span>Camping y Aventura (35%)</span>
                        <span class="text-success">$119.175</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-success" style="width: 35%"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1 small fw-semibold">
                        <span>Náutica y Otros (10%)</span>
                        <span class="text-warning">$34.050</span>
                    </div>
                    <div class="progress mb-3" style="height: 10px;">
                        <div class="progress-bar bg-warning" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 border-top border-dark border-3 p-4 bg-white">
        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Top 3 Productos Más Vendidos
        </h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle border mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 10%;">Puesto</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Unidades Vendidas</th>
                        <th>Total Recaudado Estático</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3"><span class="badge bg-warning text-dark fw-bold fs-6">#1</span></td>
                        <td class="fw-bold text-dark">Caña de Pescar Shimano Alivio 2.40mts</td>
                        <td><span class="badge bg-light text-dark border">Pesca</span></td>
                        <td>42 unidades</td>
                        <td class="fw-semibold text-success">$1.911.000</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-secondary fw-bold fs-6">#2</span></td>
                        <td>Carpa Igloo Coleman 4 Personas Waterproof</td>
                        <td><span class="badge bg-light text-dark border">Camping</span></td>
                        <td>18 unidades</td>
                        <td class="fw-semibold text-success">$2.160.000</td>
                    </tr>
                    <tr>
                        <td class="ps-3"><span class="badge bg-danger fw-bold fs-6">#3</span></td>
                        <td>Reel Frontal Spinit Albatros 4000</td>
                        <td><span class="badge bg-light text-dark border">Pesca</span></td>
                        <td>15 unidades</td>
                        <td class="fw-semibold text-success">$487.500</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
