<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de viaje: </h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">

                    <h4>Detalle de Viajes</h4>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>

                    <div>
                        @foreach($arrPuntos as $index => $puntosResult)
                            <div class="row">

                                <div class="col-4 col-lg-2">
                                    <div class="input-group input-group-static mt-3">
                                        <label>Orden</label>
                                        <input type="number" name="" wire:model="arrPuntos.{{$index}}.orden" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-8 col-lg-2">
                                    <div class="input-group input-group-static mt-3">
                                        <label>Punto de control</label>
                                        <select class="form-control" wire:model="arrPuntos.{{$index}}.puntos_id">
                                            <option>--Seleccione Punto de Control--</option>
                                            @foreach($puntos as $m)
                                                <option value="{{$m->id}}"> {{$m->nombre}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-6 col-lg-3">
                                    <div class="input-group input-group-static mt-3">
                                        <label>Tiempo Target</label>
                                        <input type="time" name="" wire:model="arrPuntos.{{$index}}.target" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3">
                                    <div class="input-group input-group-static mt-3">
                                        <label>Tiempo Ponderado</label>
                                        <input type="time" name="" wire:model="arrPuntos.{{$index}}.ponderacion" class="form-control"/>
                                    </div>
                                </div>

                                <div class="col col-lg-2">
                                    <button class="btn bg-gradient-success mt-3" wire:click.prevent="eliminarPunto({{$index}})"> 
                                        Eliminar
                                    </button>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <button class="btn bg-gradient-success my-4 mb-2" wire:click.prevent="agregarPunto">
                        <i class="material-icons opacity-10"> add </i> Agregar Fila
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
