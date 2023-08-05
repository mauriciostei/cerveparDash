<div wire:poll.1000ms>
    <div class="container-fluid py-4">


        <div class="row">

            <div class="col-12 @if($showTimeline) col-lg-9 @else col-lg-12 @endif">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        {{-- Caja resumen T1 --}}
                        @livewire('dashboards.statics.tier-resume', [
                            'image' => "/img/t1.png",
                            'tier' => 'T1',
                            'total' => $t1['total'],
                            'ontime' => $t1['OnTime'] ,
                            'outoftime' => $t1['OutOfTime'] ,
                            'percentage' => $t1['%'],
                        ])
                    </div>
                    <div class="col-12 col-lg-4">
                        {{-- Caja Resumen T2 --}}
                        @livewire('dashboards.statics.tier-resume', [
                            'image' => "/img/t2.png",
                            'tier' => 'T2',
                            'total' => $t2['total'],
                            'ontime' => $t2['OnTime'] ,
                            'outoftime' => $t2['OutOfTime'] ,
                            'percentage' => $t2['%'],
                        ])
                    </div>
                    <div class="col-12 col-lg-4">
                        @livewire('dashboards.statics.accuracy')
                    </div>
                </div>

                <div class="row mt-4 mt-lg-3">
                    <div class="col">
                        {{-- Mostrar u ocultar la linea de tiempo --}}
                        <button wire:click="$toggle('showTimeline')" class="btn btn-success p-2 mx-auto">
                            @if($showTimeline) Ocultar Linea de Tiempo @else Mostrar Linea de Tiempo @endif
                        </button>
                        {{-- Tabla de móviles en circulación --}}
                        @livewire('dashboards.statics.tabla-inicio', ['recorridos' => $recorridos])
                    </div>
                </div>
            </div>

            @if($showTimeline)
                <div class="col-12 col-lg-3">
                    <div class="row">
                        {{-- Tiempo T1 --}}
                        @livewire('dashboards.statics.tier-timeline', [ 'tier' => 1, 'recorridos' => $recorridos ])

                        {{-- Tiempo T2 --}}
                        @livewire('dashboards.statics.tier-timeline', [ 'tier' => 2, 'recorridos' => $recorridos ])
                    </div>
                </div>
            @endif 


        </div>

    </div>
</div>