<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Ayudantes</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="ayudante.nombre" class="form-control"/>
                    </div>
                    @error('ayudante.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Documento</label>
                        <input type="number" wire:model="ayudante.cedula" class="form-control"/>
                    </div>
                    @error('ayudante.cedula')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/><br/>

                    <div class="form-check form-switch">
                        <input wire:model="ayudante.activo" class="form-check-input" type="checkbox" >
                        <label class="form-check-label">Activo</label>
                    </div>

                    @if($ayudante->chofer)
                        <div class="d-flex flex-row">
                            Ayudante asignado al chofer: <b>{{$ayudante->chofer->nombre}}</b>
                        </div>
                    @endif

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
