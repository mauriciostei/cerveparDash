<div>
    <div class="container-fluid position-relative  py-4">

        <div class="row sticky-top mb-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">filter_alt</i>
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

        <div class="d-flex flex-column flex-lg-row justify-content-between mb-5">
            <div class="w-100 w-lg-50 me-0 me-lg-2">
                @livewire('dashboards.componentes.tabla-tiempos-puntos', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-100 w-lg-50 ms-0 ms-lg-2">
                @livewire('dashboards.componentes.tabla-t-m', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
            <div class="w-100 w-lg-32">
                @livewire('dashboards.componentes.gafica-ingreso-moviles', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-100 w-lg-32">
                @livewire('dashboards.componentes.grafica-descarga-dock', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-100 w-lg-32">
                @livewire('dashboards.componentes.grafica-descarga-movil', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
        </div>

        <div class="w-100 mb-3">
            @livewire('dashboards.componentes.tabla-tiempos-desvios-tier', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
        </div>        
        
        @livewire('dashboards.componentes.tabla-tiempos-desvios-moviles', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])


    </div>
</div>