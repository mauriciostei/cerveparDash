<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Choferes</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="chofer.nombre" class="form-control"/>
                    </div>
                    @error('chofer.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Documento</label>
                        <input type="number" wire:model="chofer.documento" class="form-control"/>
                    </div>
                    @error('chofer.documento')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <h6>Tier del Chofer</h6>
                    @forelse($tiers as $tier)
                        <div class="form-check">
                            <input class="form-check-input" wire:model="chofer.tiers_id" value={{$tier->id}} type="radio" name="flexRadioDefault">
                            <label class="custom-control-label"> {{$tier->nombre}} </label>
                        </div>
                    @empty
                        <p>No posee Tiers disponibles</p>
                    @endforelse

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Operador Logístico</label>
                        <select class="form-control" wire:model="chofer.operadoras_id">
                            <option>--Seleccione su Operador Logístico--</option>
                            @foreach($operadoras as $operador)
                                <option value="{{$operador->id}}"> {{$operador->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('chofer.operadoras_id')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Ayudante</label>
                        <select class="form-control" wire:model="chofer.ayudantes_id">
                            <option value="">--Seleccione su Ayudante--</option>
                            @foreach($ayudantes as $ayudante)
                                <option value="{{$ayudante->id}}"> {{$ayudante->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('chofer.ayudantes_id')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/><br/>

                    <div class="form-check form-switch">
                        <input wire:model="chofer.activo" class="form-check-input" type="checkbox" >
                        <label class="form-check-label">Activo</label>
                    </div>

                    <br/>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
