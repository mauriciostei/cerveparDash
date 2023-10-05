<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de viajes:</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">

                    <h5>Generalidades del Viaje de {{$tier->nombre}} </h5>

                    <select class="form-select p-2 mb-3 mt-3" wire:change.prevent="changeViaje($event.target.value)">
                        <option selected disabled>Seleccione el viaje a trabajar</option>
                        @foreach(App\Models\Viajes::all() as $v)
                            <option value="{{$v->id}}"> {{$v->nombre}} </option>
                        @endforeach
                    </select>

                    @if($viaje)

                        <div class="input-group input-group-static mb-3">
                            <label>Tiempo de Control TMA</label>
                            <input type="time" step="1" wire:model="tma" class="form-control"/>
                        </div>

                        <h5>Detalle de viaje:</h5>

                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <th>Orden</th>
                                    <th>Punto de Control</th>
                                    <th>Tiempo Target</th>
                                    <th>Tiempo Ponderado</th>
                                    <th>
                                        <span class="btn btn-neutral p-0 m-0 ms-4" wire:click.prevent="agregarPunto">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse($arrPuntos as $index => $puntosResult)
                                        <tr>
                                            <td class="w-10">
                                                {{$index + 1}}
                                            </td>
                                            <td>
                                                <select class="form-control" wire:model="arrPuntos.{{$index}}.puntos_id">
                                                    <option selected disabled>--Seleccione Punto de Control--</option>
                                                    @foreach($puntos as $m)
                                                        <option value="{{$m->id}}"> {{$m->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="time" wire:model="arrPuntos.{{$index}}.target" class="form-control" step="1"/>
                                            </td>
                                            <td>
                                                <input type="time" wire:model="arrPuntos.{{$index}}.ponderacion" class="form-control" step="1"/>
                                            </td>
                                            <td class="w-10">
                                                <button class="btn btn-neutral p-0 m-0 ms-5 me-3" wire:click.prevent="eliminarPunto({{$index}})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                @if(!$loop->first)
                                                    <button class="btn btn-neutral p-0 m-0 me-3" wire:click.prevent="mover({{$index}}, 'arriba')">
                                                        <i class="fa-solid fa-arrow-up"></i>
                                                    </button>
                                                @endif

                                                @if(!$loop->last)
                                                    <button class="btn btn-neutral p-0 m-0 me-0" wire:click.prevent="mover({{$index}}, 'abajo')">
                                                        <i class="fa-solid fa-arrow-down"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td rowspan="100" class="text-center text-muted">Sin datos por mostrar</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @foreach ($errors->all() as $error)
                            <div class="text-center text-danger"> {{$error}} </div>
                        @endforeach

                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                        </div>

                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
