<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Problemas</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label >Nombre</label>
                        <input type="text" wire:model="problema.nombre" class="form-control"/>
                    </div>
                    @error('problema.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="form-check form-switch">
                        <input wire:model="problema.activo" class="form-check-input" type="checkbox" >
                        <label class="form-check-label">Activo</label>
                    </div>

                    <br/>

                    <div class="d-flex flex-column p-2">
                        <h6>Soluciones del Problema</h6>
                        @forelse($soluciones as $solucion)
                            <div class="form-check form-switch">
                                <input wire:model="selectedP.{{ $solucion->id }}" class="form-check-input" type="checkbox">
                                <label class="form-check-label">{{$solucion->nombre}}</label>
                            </div>
                        @empty
                            <div class="">Lista Vacia!</div>
                        @endforelse
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
