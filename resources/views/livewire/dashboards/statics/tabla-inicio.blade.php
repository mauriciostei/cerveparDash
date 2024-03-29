<div class="card" wire:poll.1000ms>
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-xl-10">
                <h6>Móviles circulantes</h6>
            </div>
            <div class="col-xl-2">
                <div class="btn-group" role="group">
                    <a wire:click.prevent="historial" class="btn btn-success p-2">Historial</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body px-0 m-2">
        <div class="table-responsive">

            <table class="table table-sm table-hover table-striped align-items-center mb-0">
                <thead>
                    @livewire('dashboards.statics.filters')
                </thead>
                <tbody>
                    @forelse($recorridos  as $r)
                        <tr>
                            <td class="text-secondary text-xs text-center"> {{$r->tiers->nombre}} </td>
                            <td class="text-secondary text-xs text-center"> {{explode(' ',$r->inicio)[1]}} </td>
                            <td class="text-secondary text-xs text-center"> {{$r->moviles->nombre}} </td>
                            <td class="text-secondary text-xs text-center"> @if($r->choferes->operadoras) {{$r->choferes->operadoras->nombre}} @endif </td>
                            <td class="text-secondary text-xs text-center"> {{$r->choferes->nombre}} </td>
                            <td class="text-secondary text-xs text-center"> {{$r->puntos->nombre}} </td>
                            <td class="text-secondary text-xs text-center"> {{$this->difTime($r->inicio)}} </td>
                            <td class="text-secondary text-xs text-center"> {{explode(' ',$r->target)[1]}} </td>
                            <td class="text-secondary text-xs text-center">
                                @if($r->estado == 'OnTime')
                                    <span class="text-success">{{$r->estado}}</span>
                                @elseif($r->estado == 'OutOfTime')
                                    <span class="text-danger">{{$r->estado}}</span>
                                @else
                                    <span class="text-warning">{{$r->estado}}</span>
                                @endif
                            </td>
                            <td class="text-secondary text-xs text-center">
                                <span class="font-weight-bold {{ $this->getColor( $this->difTime($this->getInicio($r->choferes_id, $r->moviles_id, $r->tiers_id, $r->viaje)), $r->tiers_id ) }}">
                                    {{ $this->difTime($this->getInicio($r->choferes_id, $r->moviles_id, $r->tiers_id, $r->viaje)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Tabla vacía, esperando datos...</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>