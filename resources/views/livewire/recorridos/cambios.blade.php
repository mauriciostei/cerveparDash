<div class="container-fluid py-4">

    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Cambios en Recorridos</h6>
            </div>
        </div>
        <div class="card-body px-4 pb-2">
            
            <p class="my-2 text-muted">Seleccione los filtros para desplegar los resultados posibles</p>
            
            <div class="input-group input-group-sm input-group-static">
                <label>Fecha</label>
                <input type="date" wire:model="fecha" class="form-control">
            </div>

            <div class="input-group input-group-static mt-3">
                <label>Viaje</label>
                <select class="form-control" wire:model="cambio.viaje">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="input-group input-group-static mt-3">
                <label>Movil</label>
                <select class="form-control" wire:model="cambio.moviles_id">
                    @forelse($moviles as $m)
                        <option value="{{$m->id}}"> {{$m->nombre}} </option>
                    @empty
                    @endforelse
                </select>
            </div>

            <div class="input-group input-group-static mt-3 mb-3">
                <label>Chofer</label>
                <select class="form-control" wire:model="cambio.choferes_id">
                    @forelse($choferes as $c)
                        <option value="{{$c->id}}"> {{$c->nombre}} </option>
                    @empty
                    @endforelse
                </select>
            </div>

            @if($ideal)
                <div class="d-flex flex-column flex-lg-row justify-content-between pt-3">

                    <div class="timeline timeline-one-side w-100 w-lg-25">

                        @forelse($ideal->puntos->where('pivot.viaje', $cambio->viaje) as $punto)
                            <div class="timeline-block mb-2">
                                <span class="timeline-step"></span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0"> {{$punto->nombre}}
                                    </h6>
                                    <div class="text-xs mt-1 mb-0">
                                        @if($this->getRecorrido($punto->id))
                                            Movil: <b> {{$this->getRecorrido($punto->id)->moviles->nombre}} </b>
                                            <br/>
                                            Chofer: <b> {{$this->getRecorrido($punto->id)->choferes->nombre}} </b>
                                            <br/>
                                            Inicio: <b> {{$this->getRecorrido($punto->id)->inicio}} </b>
                                            <br/>
                                            Estado: <b> {{$this->getRecorrido($punto->id)->estado}} </b>
                                        @else
                                            @if($this->solicitudEnCurso($punto->id))
                                                <div class="text-danger">Solicitud en Curso!</div>
                                            @else
                                                <button wire:click.prevent="chosePunto({{$punto->id}})" class="btn btn-primary">Corregir</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted">Aun no existen rutas para este Tier</div>
                        @endforelse
                    </div>

                    <div class="mt-3 mt-lg-0 w-100 w-lg-75">
                        <h6>Corregir Recorrido</h6>
                        <p class="text-muted">Se debe cargar la hora en formato de 24 horas con los segundos estimados</p>

                        @if($cambio->puntos_id)
                            <form wire:submit.prevent="save">

                                @error('cambio.viaje')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.moviles_id')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.choferes_id')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.tiers_id')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.puntos_id')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.sensores_id')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('cambio.inicio')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror
                                @error('observacion')
                                    <div class='text-danger inputerror'>{{ $message }} </div>
                                @enderror

                                <div class="input-group input-group-static mt-3 mb-3">
                                    <label>Sensor</label>
                                    <select class="form-control" wire:model="cambio.sensores_id">
                                        <option selected>Seleccione el sensor</option>
                                        @forelse($sensores as $c)
                                            <option value="{{$c->id}}"> {{$c->nombre}} </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="input-group input-group-sm input-group-static mb-3">
                                    <label>Hora</label>
                                    <input type="time" wire:model="hora" class="form-control" step="1">
                                </div>

                                <div class="input-group input-group-sm input-group-static mb-3">
                                    <label>Observaciones</label>
                                    <textarea class="form-control" wire:model="observacion"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Solicitar</button>
                                </div>
                            </form>

                        @endif
                    </div>

                </div>
            @endif

        </div>
    </div>

</div>
