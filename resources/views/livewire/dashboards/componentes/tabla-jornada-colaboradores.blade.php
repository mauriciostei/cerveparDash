<div wire:poll.1000ms class="card w-100 shadow">
    <button class="btn btn-primary shadow mb-0 mt-0" wire:click.prevent="exportar">Exportar</button>
    <div class="card-body table-responsive p-3">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Colaborador</th>
                    <th>Fecha</th>
                    <th class="text-center">Entrada <sup style="color: darkturquoise;">(A)</sup> </th>
                    <th class="text-center">Salida <sup style="color: darkturquoise;">(B)</sup> </th>
                    <th class="text-center">Jornada <sup style="color: darkturquoise;">A + B</sup> </th>
                </tr>
            </thead>
            <tbody>
                @forelse($jornada as $item)
                    <tr>
                        <td> {{$item->colaborador}} </td>
                        <td> {{$item->fecha}} </td>

                        <td class="text-center"> {{$item->entrada ?? '00:00:00'}} </td>
                        <td class="text-center"> {{$item->salida ?? '00:00:00'}} </td>
                        
                        
                        <td class="text-center"> {{ $this->difTimeFromOnlyTime($item->entrada, $item->salida) }} </td>
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
