<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-lg-10">
                            <h6 class="text-white text-capitalize ps-3">Formulario de Colaboradores</h6>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('colaboradoresList') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-step-backward"></i> Regresar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="colaborador.nombre" class="form-control"/>
                    </div>
                    @error('colaborador.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="input-group input-group-static mt-3">
                        <label>Documento</label>
                        <input type="number" wire:model="colaborador.cedula" class="form-control"/>
                    </div>
                    @error('colaborador.cedula')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
