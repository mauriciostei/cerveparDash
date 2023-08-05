<div>
    <div class="container-fluid position-relative py-2" style="z-index: 200;">

        <div class="row sticky-top mb-4 pb-2">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-filter opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Métricas </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-2">

                        <div class="row">

                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.1" class="form-check-input" type="checkbox" wire:change="emitir" >
                                    <label class="form-check-label">T1</label>
                                </div>
                            </div>
                            
                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.2" class="form-check-input" type="checkbox" wire:change="emitir" >
                                    <label class="form-check-label">T2</label>
                                </div>
                            </div>

                            <div class="col-6 col-lg-5">
                                <div class="input-group input-group-sm input-group-static">
                                    <label>Desde</label>
                                    <input type="date" wire:model="desde" class="form-control" wire:change="emitir"/>
                                </div>
                            </div>

                            <div class="col-6 col-lg-5">
                                <div class="input-group input-group-sm input-group-static">
                                    <label>Hasta</label>
                                    <input type="date" wire:model="hasta" class="form-control" wire:change="emitir"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
            <div class="w-100 w-lg-33">
                <div class="mb-3">
                    @livewire('dashboards.componentes.tabla-tiempos-puntos', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                </div>
                <div class="mb-3">
                    @livewire('dashboards.componentes.tabla-t-m', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                </div>
                <div class="mb-3 pb-4">
                    @livewire('dashboards.componentes.tiempos-financieros', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                </div>
                <div class="mb-3">
                    @livewire('dashboards.componentes.gafica-ingreso-moviles', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                </div>
            </div>
            <div class="w-100 w-lg-33 ms-lg-3 me-lg-3">
                <div class="text-center display-6 font-weight-bold mb-3">T1</div>
                <div class="mb-3 pb-4">
                    @livewire('dashboards.componentes.grafica-descarga-dock', ['desde' => $desde, 'hasta' => $hasta, 'id_div' => 'descarga_dock_t1'])
                </div>
                <div class="mb-3 pb-3">
                    @livewire('dashboards.componentes.grafica-descarga-movil', ['desde' => $desde, 'hasta' => $hasta, 'id_div' => 'descarga_movil_t1'])
                </div>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 ">Regla de decision:</h6>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <tr>
                                    <th>0 a 15 minutos</th>
                                    <th>Seguir la descarga</th>
                                </tr>
                                <tr>
                                    <th>15 a 30 minutos</th>
                                    <th>Monitorear</th>
                                </tr>
                                <tr>
                                    <th>30 a 45 minutos</th>
                                    <th>Refuerzo de AE para descarga o carga</th>
                                </tr>
                                <tr>
                                    <th>Mayor a 45 minutos</th>
                                    <th>Liberar en falso</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 w-lg-33">
                <div class="text-center display-6 font-weight-bold mb-3">T2</div>
                <div class="mb-3 pb-4">
                    @livewire('dashboards.componentes.grafica-descarga-dock', ['desde' => $desde, 'hasta' => $hasta, 'id_div' => 'descarga_dock_t2'])
                </div>
                <div class="mb-3 pb-3">
                    @livewire('dashboards.componentes.grafica-descarga-movil', ['desde' => $desde, 'hasta' => $hasta, 'id_div' => 'descarga_movil_t2'])
                </div>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-0 ">Regla de decision:</h6>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <tr>
                                    <th>0 a 5 minutos</th>
                                    <th>Monitorear</th>
                                </tr>
                                <tr>
                                    <th>6 a 9 minutos</th>
                                    <th>Solicitar prioridad a zona de descarga</th>
                                </tr>
                                <tr>
                                    <th>10 a 15 minutos</th>
                                    <th>Solicitar prioridad a zona de chequeo</th>
                                </tr>
                                <tr>
                                    <th>Mayor a 15 minutos</th>
                                    <th>Solicitar liberación inmediata de WH</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 mb-3">
            @livewire('dashboards.componentes.tabla-tiempos-desvios-tier', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
        </div>        
        
        @livewire('dashboards.componentes.tabla-tiempos-desvios-moviles', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])


    </div>
</div>