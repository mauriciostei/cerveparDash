<div wire:poll.1s class="card mt-2">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Movil</th>
                        <th>Chofer</th>
                        <th>Zona</th>
                        <th>Hora Detectada</th>
                        <th>Tiempo Retraso</th>
                        <th>Anomalía</th>
                        <th>Resuelto Por</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alertas as $item)
                        <tr>
                            <td> {{$item->id}} </td>
                            <td> {{$item->recorridos->moviles->nombre}} </td>
                            <td> - </td>
                            <td> {{$item->recorridos->puntos->nombre}} </td>
                            <td> {{$item->recorridos->inicio}} </td>
                            <td>
                                @if(!$item->fin)
                                    {{$this->difTime($item->inicio)}}
                                @else
                                    {{$item->fin}}
                                @endif
                            </td>
                            <td>
                                @if($item->problemas_id)
                                    {{$item->problemas->nombre}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->users_id)
                                    {{$item->users->name}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->recorridos->estado == 'Dismiss')
                                    <span class="text-danger">Alerta Eliminada (Dismiss)</span>
                                @endif
                                @if($item->recorridos->estado == 'OutOfTime' && !$item->visible && !$item->users_id)
                                    <span class="text-danger">Alerta Eliminada (PDC alcanzado)</span>
                                @endif
                                @if($item->recorridos->estado == 'OutOfTime' && $item->users_id && !$item->fin)
                                    <span class="text-warning">En curso</span>
                                @endif
                                @if($item->recorridos->estado == 'OutOfTime' && $item->soluciones_id)
                                    <span class="text-success">Resuelto</span>
                                @endif
                                @if($item->recorridos->estado == 'OutOfTime' && !$item->fin && !$item->users_id)
                                    <span class="text-warning">Sin Asignar</span>
                                @endif
                            </td>
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
