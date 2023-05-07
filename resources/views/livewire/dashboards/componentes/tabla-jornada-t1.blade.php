<div wire:poll.1000ms class="w-100">

    <div class="py-3">
        @livewire('dashboards.componentes.grafica-jornada-t1', ['desde' => $desde, 'hasta' => $hasta, 'tiers' => $tiers])
    </div>

    <button class="btn btn-primary shadow mb-0 mt-0 w-100" wire:click.prevent="exportar">Exportar</button>
    <div class="card w-100 shadow card-body table-responsive p-3">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Tiers</th>
                    <th>Choferes</th>
                    <th>Móviles</th>
                    <th class="text-center">Espera <sup style="color: darkturquoise;">(A)</sup> </th>
                    <th class="text-center">Atendimiento <sup style="color: darkturquoise;">(B)</sup> </th>
                    <th class="text-center">Permanencia <sup style="color: darkturquoise;">A + B</sup> </th>
                </tr>
            </thead>
            <tbody>
                @forelse($jornada as $item)
                    <tr>
                        <td> {{$item->tiers_nombre}} </td>
                        <td> {{$item->chofer_nombre}} </td>
                        <td> {{$item->movil_nombre}} </td>

                        <td class="text-center"> {{$item->espera}} </td>
                        <td class="text-center"> {{$item->atendimiento}} </td>
                        
                        <td class="text-center"> {{$item->ttotal}} </td>
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
