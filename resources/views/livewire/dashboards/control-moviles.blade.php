<div wire:poll.1000ms>
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">filter_alt</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Control de móviles </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-0">

                        <div class="row">

                            <div class="col-12 col-lg-4">
                                <div class="input-group input-group-static mt-3">
                                    <label>Tiers</label>
                                    <select class="form-control" wire:model="tiers_id">
                                        @forelse($tiers as $t)
                                            <option value="{{$t->id}}"> {{$t->nombre}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col"></div>

                            <div class="col-12 col-lg-4">
                                <div class="input-group input-group-static mt-3">
                                    <label>Viaje</label>
                                    <select class="form-control" wire:model="viaje">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>
  

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row pt-2">
            @forelse($puntos as $p)
                @if($p != $loop->last)
                    <div class="col">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 data-toggle="tooltip" data-placement="top" title="Tiempo target {{ $p->target }}">
                                    {{$this->getPunto($p->puntos_id)}}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @forelse($recorridos->where('puntos_id', $p->puntos_id) as $r)
                                        <div class="col text-center text-bold text-lg">
                                            <span data-toggle="tooltip" data-placement="top" title="Hora de inicio {{ $r->inicio }}, hora target {{ $r->target }}">
                                                @switch($r->estado)
                                                    @case('OnTime')
                                                        <span class="text-success"> {{$r->moviles->nombre}} </span>
                                                    @break
                                                    @case('OutOfTime')
                                                        <span class="text-danger"> {{$r->moviles->nombre}} </span>
                                                    @break
                                                    @case('Dismiss')
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
            @empty
                <div class="text-muted text-center">
                    Sin datos presentes
                </div>
            @endforelse
        </div>


    </div>
</div>