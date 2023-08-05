<div class="col-lg-6 mt-4 mt-lg-0" wire:poll.1000ms>
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6>{{$tiers->nombre}}, Viaje: {{$viaje}} </h6>
        </div>
        <div class="card-body p-3">
            <div class="timeline timeline-one-side">

                @forelse($tiers->puntos as $punto)
                    @if($punto->pivot->viaje == $viaje)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-location-dot text-primary text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"> {{$punto->nombre}}: {{$punto->pivot->target}}
                                </h6>
                                <div class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                    <div>On Time: <span class="text-success">
                                        {{$recorridos->where('tiers_id', $tiers->id)->where('viaje', $viaje)->where('estado', 'OnTime')->where('puntos_id', $punto->id)->count()}}    
                                    </span> </div>
                                    <div>Out Of Time: <span class="text-danger">
                                        {{$recorridos->where('tiers_id', $tiers->id)->where('viaje', $viaje)->where('estado', 'OutOfTime')->where('puntos_id', $punto->id)->count()}}      
                                    </span> </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div>Aun no existen rutas para este Tier</div>
                @endforelse
            </div>
            <button class="btn btn-success w-100" wire:click.prevent="cambiarViaje()">Cambiar Viaje </button>
        </div>
    </div>
</div>