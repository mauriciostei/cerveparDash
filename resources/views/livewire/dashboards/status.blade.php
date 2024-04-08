<div wire:poll.1000ms>
    <div class="container-fluid">

        <div class="row">
            @foreach($tiers as $tier)
                 <h3 class="text-muted my-3"> {{$tier->nombre}} </h3>


                 <div class="row">
                    @foreach($tier->puntos->unique('nombre') as $punto)
                        @if($punto != $loop->last)
                            <div class="col">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h6 data-toggle="tooltip" data-placement="top" title="Tiempo target {{ $punto->pivot->target }}"> {{$punto->nombre}} </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @forelse($recorridos->where('puntos_id', $punto->id)->where('tiers_id', $tier->id) as $r)
                                                <div class="col text-center text-bold text-lg">
                                                    <span data-toggle="tooltip" data-placement="top" title="Hora de inicio {{ $r->inicio }}, hora target {{ $r->target }}">
                                                        @switch($r->estado)
                                                            @case('OnTime')
                                                                <span class="text-success"> {{$r->moviles ? $r->moviles->nombre : ''}} </span>
                                                            @break
                                                            @case('OutOfTime')
                                                                <span class="text-danger"> {{$r->moviles ? $r->moviles->nombre : ''}} </span>
                                                            @break
                                                            @default
                                                                <span class="text-warning"> {{$r->moviles ? $r->moviles->nombre : ''}} </span>
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