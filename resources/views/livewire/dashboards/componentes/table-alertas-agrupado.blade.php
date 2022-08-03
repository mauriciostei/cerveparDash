<div wire:poll.keep-alive class="card mt-2">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>Anomalía</th>
                        <th>Cantidad</th>
                        <th>Zona</th>
                        <th>Promedio de resolución</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alertas as $item)
                        <tr>
                            <td>
                                @if($item->problema_nombre)
                                    {{$item->problema_nombre}}
                                @else
                                    Sin Anomalía Asignada
                                @endif
                            </td>
                            <td> {{$item->cantidad}} </td>
                            <td> {{$item->punto_nombre}} </td>
                            <td> {{$item->tiempo_medio}} </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-muted text-center" colspan="10">Sin alertas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$alertas->links()}}
        </div>

    </div>
</div>
