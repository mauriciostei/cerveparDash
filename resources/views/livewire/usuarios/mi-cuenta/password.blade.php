<form wire:submit.prevent="save">
    <div class="card my4">
        <div class="card-body">
            
            <div class="input-group input-group-static mt-3">
                <label>Contraseña Actual</label>
                <input type="password" wire:model="password" class="form-control" autocomplete="off"/>
            </div>
            @error('password')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror

            <div class="input-group input-group-static mt-3">
                <label>Contraseña nueva</label>
                <input type="password" wire:model="newpassword1" class="form-control" autocomplete="off"/>
            </div>
            @error('newpassword1')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror

            <div class="input-group input-group-static mt-3">
                <label>Contraseña nueva</label>
                <input type="password" wire:model="newpassword2" class="form-control" autocomplete="off"/>
            </div>
            @error('newpassword2')
                <p class='text-danger inputerror'>{{ $message }} </p>
            @enderror

        </div>
        <div class="card-footer align-self-end">
            <input type="submit" value="Guardar" class="btn btn-success"/>
        </div>
    </div>
</form>