<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Sensores</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="sensor.nombre" class="form-control"/>
                    </div>
                    @error('sensor.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Codigo</label>
                        <input type="text" wire:model="sensor.codigo" class="form-control"/>
                    </div>
                    @error('sensor.codigo')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <h6>Punto del sensor</h6>
                    @forelse($puntos as $punto)
                        <div class="form-check">
                            <input class="form-check-input" wire:model="sensor.puntos_id" value={{$punto->id}} type="radio" name="flexRadioDefault">
                            <label class="custom-control-label"> {{$punto->nombre}} </label>
                        </div>
                    @empty
                        <p>No posee Puntos disponibles</p>
                    @endforelse

                    <br/><br/>

                    <div class="form-check form-switch">
                        <input wire:model="sensor.activo" class="form-check-input" type="checkbox" >
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