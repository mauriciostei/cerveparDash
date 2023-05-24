<div wire:poll.1000ms class="card w-100 shadow">
    <button class="btn btn-primary shadow mb-0 mt-0" wire:click.prevent="exportar">Exportar</button>
    <div class="card-body table-responsive p-3">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Tiers</th>
                    <th>Fecha</th>
                    <th>Choferes</th>
                    <th>Móviles</th>
                    <th class="text-center">TML <sup style="color: darkturquoise;">(A)</sup> </th>
                    <th class="text-center">TR <sup style="color: darkturquoise;">(B)</sup> </th>
                    <th class="text-center">T. Interno <sup style="color: darkturquoise;">(C) = i + ii </sup> </th>
                    <th class="text-center">T. Financiero <sup style="color: darkturquoise;">(I)</sup> </th>
                    <th class="text-center">T. Warehouse <sup style="color: darkturquoise;">(II)</sup> </th>
                    <th class="text-center">Jornada <sup style="color: darkturquoise;">A + B + C</sup> </th>
                </tr>
            </thead>
            <tbody>
                @forelse($jornada as $item)
                    <tr>
                        <td> {{$item->tiers_nombre}} </td>
                        <td> {{$item->fecha}} </td>
                        <td> {{$item->chofer_nombre}} </td>
                        <td> {{$item->movil_nombre}} </td>
                        <td class="text-center"> {{$item->tml}} </td>
                        <td class="text-center"> {{$item->tr}} </td>
                        <td class="text-center"> {{$item->tmi}} </td>
                        <td class="text-center"> {{$item->tfinanciero}} </td>
                        <td class="text-center"> {{$item->warehouse}} </td>
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
