<form wire:submit.prevent="save">
    <div class="card my4">
        <div class="card-body">
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

            <div class="input-group input-group-static mt-3">
                <label>Avatar</label>
                <input type="file" wire:model="avatar" class="form-control"/>
            </div>
            @error('avatar')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror
        </div>
        <div class="card-footer align-self-end">
            <input type="submit" value="Guardar" class="btn btn-success"/>
        </div>
    </div>
</form>