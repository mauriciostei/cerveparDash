
<div wire:poll.1000ms>
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-filter opacity-10"></i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Control de móviles </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-0">

                        <div class="row">

                            <div class="col-12 col-lg-3">
                                <div class="input-group input-group-static mt-3">
                                    <label>Fecha</label>
                                    <input type="date" wire:model="fecha" class="form-control">
                                </div>
                            </div>

                            <div class="col"></div>

                            <div class="col-12 col-lg-3">
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

                            <div class="col-12 col-lg-3">
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

        <div class="table-responsive mt-3 card card-body">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th>Movil</th>
                        <th>Chofer</th>
                        @foreach($puntos as $p)
                            <th class="text-center"> {{$this->getPunto($p->puntos_id)}} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->recorridos as $recorrido)
                        <tr>
                            <td> {{$recorrido->moviles_nombre}} </td>
                            <td> {{strtoupper($recorrido->choferes_nombre)}} </td>
                            @foreach($puntos as $p)
                                <td class="text-center">
                                    @if($this->getRecorrido($recorrido->moviles_id, $p->puntos_id))
                                        <span class="text-success">
                                            {{$this->getRecorrido($recorrido->moviles_id, $p->puntos_id)}}
                                        </span>
                                    @else
                                        <span class="text-danger">X</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <th class="text-center text-muted" colspan="100">Sin datos por mostrar</th>
                        </tr>
                        @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>