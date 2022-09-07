<div>
    <div class="container-fluid position-relative py-4 mt-0 pt-0" style="z-index: 200;">

        <div class="row sticky-top">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">filter_alt</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Alertas </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-2">

                        <div class="row">

                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.1" class="form-check-input" type="checkbox" wire:change="emitir">
                                    <label class="form-check-label">T1</label>
                                </div>
                            </div>
                            
                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.2" class="form-check-input" type="checkbox" wire:change="emitir">
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

        <div class="d-flex flex-column flex-lg-row justify-content-between mt-5 mb-3">
            <div class="w-32">
                @livewire('dashboards.componentes.grafica-desvios-medios', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-32">
                @livewire('dashboards.componentes.gafica-top-desvios', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-32">
                @livewire('dashboards.componentes.gafica-anomalias-hora', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row justify-content-between mt-5 mb-3">
            <div class="w-50 me-2">
                @livewire('dashboards.componentes.grafica-velas-alertas-tiempo', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-50 ms-2">
                @livewire('dashboards.componentes.grafica-velas-alertas-cantidad', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
        </div>
       
        @livewire('dashboards.componentes.table-alertas', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])

        <div class="d-flex flex-column flex-lg-row justify-content-between">
            <div class="w-100 w-lg-50 me-0 me-lg-2">
                @livewire('dashboards.componentes.table-alertas-agrupado', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
            <div class="w-100 w-lg-50 ms-0 ms-lg-2">
                @livewire('dashboards.componentes.table-alertas-top', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
            </div>
        </div>

    </div>
</div>