<div wire:poll.1000ms>
    <div class="container-fluid">

        <div class="row">
            @foreach($tiers as $tier)
                 <h3 class="text-muted my-3"> {{$tier->nombre}} </h3>


                 <div class="row">
                    <h6 class="text-muted">Viaje 1:</h6>
                    @foreach($tier->puntos->where('pivot.viaje',1) as $punto)
                        @if($punto != $loop->last)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h6 data-toggle="tooltip" data-placement="top" title="Tiempo target {{ $punto->pivot->target }}"> {{$punto->nombre}} </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @forelse($recorridos->where('puntos_id', $punto->id)->where('viaje', $punto->pivot->viaje) as $r)
                                                <div class="col text-center text-bold text-lg">
                                                    <span data-toggle="tooltip" data-placement="top" title="Hora de inicio {{ $r->inicio }}, hora target {{ $r->target }}">
                                                        @switch($r->estado)
                                                            @case('OnTime')
                                                                <span class="text-success"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                            @case('OutOfTime')
                                                                <span class="text-danger"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                            @default
                                                                <span class="text-warning"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                        @endswitch
                                                    </span>
                                                </div>
                                            @empty
                                                <div class="col text-muted text-center">
                                                    Sin móviles circulando
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                 
                <div class="row mt-3">
                    <h6 class="text-muted">Viaje 2:</h6>
                    @foreach($tier->puntos->where('pivot.viaje',2) as $punto)
                        @if($punto != $loop->last)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h6 data-toggle="tooltip" data-placement="top" title="Tiempo target {{ $punto->pivot->target }}"> {{$punto->nombre}} </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @forelse($recorridos->where('puntos_id', $punto->id)->where('viaje', $punto->pivot->viaje) as $r)
                                                <div class="col text-center text-bold text-lg">
                                                    <span data-toggle="tooltip" data-placement="top" title="Hora de inicio {{ $r->inicio }}, hora target {{ $r->target }}">
                                                        @switch($r->estado)
                                                            @case('OnTime')
                                                                <span class="text-success"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                            @case('OutOfTime')
                                                                <span class="text-danger"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                            @default
                                                                <span class="text-warning"> {{$r->moviles->nombre}} </span>
                                                            @break
                                                        @endswitch
                                                    </span>
                                                </div>
                                            @empty
                                                <div class="col text-muted text-center">
                                                    Sin móviles circulando
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>


            @endforeach
        </div>


    </div>
</div>