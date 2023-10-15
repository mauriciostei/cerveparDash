<div wire:poll.1s class="card mt-2">
    <div class="card-header d-flex flex-row justify-content-between mb-0">
        <h5 class="mb-0 mt-0">Alertas en curso</h5>
        <button class="btn btn-primary shadow mb-0 mt-0" wire:click.prevent="historial">Historial</button>
    </div>
    <div class="card-body mt-0">

        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Móvil</th>
                        <th class="text-center">Chofer</th>
                        <th>Inicio Jornada</th>
                        <th>TMA Alcanzado</th>
                        <th>TMA Total</th>
                        <th>Causa</th>
                        <th>Trabajado Por</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alertas as $item)
                        <tr>
                            <td> {{$item->id}} </td>
                            <td class="text-center"> {{$item->recorridos->moviles->nombre}} </td>
                            <td class="text-center"> {{$item->recorridos->choferes->nombre}} </td>
                            <td> {{$item->recorridos->inicio}} </td>
                            <td> {{$item->created_at}} </td>
                            <td>
                                @if(!$item->fin)
                                    {{$this->difTime($item->created_at)}}
                                @else
                                    {{$item->fin}}
                                @endif
                            </td>
                            <td>
                                @if($item->causas_id)
                                    {{$item->causas->nombre}}
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
