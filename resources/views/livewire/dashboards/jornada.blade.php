<div>
    <div class="container-fluid position-relative  py-4" style="z-index: 200;">
        <div class="row sticky-top mb-3">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-filter opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Jornada Laboral </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-2">

                        <div class="row">

                            <div class="col-6">
                                <div class="input-group input-group-sm input-group-static">
                                    <label>Desde</label>
                                    <input type="date" wire:model="desde" class="form-control" wire:change="emitir"/>
                                </div>
                            </div>

                            <div class="col-6">
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

        <div class="d-flex flex-column flex-lg-row justify-content-between mb-5 w-100">
            @switch($url)
                @case('jornadafa')
                    @livewire('dashboards.componentes.tabla-jornada-fa', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @case('jornada-oviedo')
                    @livewire('dashboards.componentes.tabla-jornada-oviedo', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @case('jornada-guarambare')
                    @livewire('dashboards.componentes.tabla-jornada-guarambare', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @case('jornadaT1')
                    @livewire('dashboards.componentes.tabla-jornada-t1', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @case('jornadaAyudante')
                    @livewire('dashboards.componentes.tabla-jornada-ayudantes', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @case('jornadaColaboradores')
                    @livewire('dashboards.componentes.tabla-jornada-colaboradores', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
                @default
                    @livewire('dashboards.componentes.tabla-jornada', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
                @break
            @endswitch
        </div>


    </div>
</div>