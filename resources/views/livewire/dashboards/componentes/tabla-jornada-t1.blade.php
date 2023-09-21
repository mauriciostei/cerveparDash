<div wire:poll.1000ms class="w-100">

    <div class="py-3">
        @livewire('dashboards.componentes.grafica-jornada-t1', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
    </div>

    <button class="btn btn-primary shadow mb-0 mt-0 w-100" wire:click.prevent="exportar">Exportar</button>
    <div class="card w-100 shadow card-body table-responsive p-3">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th class="text-center">Tiers</th>
                    <th class="text-center">Viaje</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Choferes</th>
                    <th class="text-center">Móviles</th>
                    <th class="text-center">Hora</th>
                    <th class="text-center">Turno</th>
                    <th class="text-center">Espera <sup style="color: darkturquoise;">(A)</sup> </th>
                    <th class="text-center">Atendimiento <sup style="color: darkturquoise;">(B)</sup> </th>
                    <th class="text-center">Permanencia <sup style="color: darkturquoise;">A + B</sup> </th>
                </tr>
            </thead>
            <tbody>
                @forelse($jornada as $item)
                    <tr>
                        <td class="text-center"> {{$item->tiers_nombre}} </td>
                        <td class="text-center"> {{$item->viaje}} </td>
                        <td class="text-center"> {{$item->fecha}} </td>
                        <td class="text-center"> {{$item->chofer_nombre}} </td>
                        <td class="text-center"> {{$item->movil_nombre}} </td>

                        <td class="text-center"> {{ $this->getInicio($item->moviles_id, $item->choferes_id, $item->viaje, $item->fecha) }} </td>
                        <td class="text-center"> {{ $this->getTurno($item->moviles_id, $item->choferes_id, $item->viaje, $item->fecha) }} </td>

                        <td class="text-center"> <span class="{{$this->getColor($item->espera, ENV('T_ESPERA'))}}">{{$item->espera}}</span> </td>
                        <td class="text-center"> <span class="{{$this->getColor($item->atendimiento, ENV('T_ATENDIMIENTO'))}}">{{$item->atendimiento}}</span> </td>
                        <td class="text-center"> <span class="{{$this->getColor($item->ttotal, ENV('T_PERMANENCIA'))}}">{{$item->ttotal}}</span> </td>
                    </tr>
                @empty
                    <tr>
                        <th class="text-center text-muted" colspan="100">Sin registros!</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
