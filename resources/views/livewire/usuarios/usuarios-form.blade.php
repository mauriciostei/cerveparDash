<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Usuarios</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">

                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="usuario.name" class="form-control"/>
                    </div>
                    @error('usuario.name')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <div class="input-group input-group-static mt-3">
                        <label>Correo</label>
                        <input type="email" wire:model="usuario.email" class="form-control"/>
                    </div>
                    @error('usuario.email')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="d-flex flex-column p-2">
                        <h6>Perfiles del Usuario</h6>
                        @forelse($perfiles as $perfil)
                            <div class="form-check form-switch">
                                <input wire:model="selectedP.{{ $perfil->id }}" class="form-check-input" type="checkbox">
                                <label class="form-check-label">{{$perfil->nombre}}</label>
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
