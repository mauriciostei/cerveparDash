<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Puntos</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label >Nombre</label>
                        <input type="text" wire:model="punto.nombre" class="form-control"/>
                    </div>
                    @error('punto.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    {{$punto}}

                    <div class="d-flex flex-row justify-content-between">
                        <div class="input-group input-group-static w-50 me-2">
                            <label>Tiempo Mínimo</label>
                            <input type="time" wire:model="punto.minimo" class="form-control" step="1"/>
                            @error('punto.minimo')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="input-group input-group-static w-50 ms-2">
                            <label>Tiempo Máximo</label>
                            <input type="time" wire:model="punto.maximo" class="form-control" step="1"/>
                            @error('punto.maximo')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>

                    <br>

                    <div class="form-check form-switch mt-3">
                        <input wire:model="punto.activo" class="form-check-input" type="checkbox" >
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
