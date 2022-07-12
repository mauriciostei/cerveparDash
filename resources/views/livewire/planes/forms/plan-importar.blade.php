<form wire:submit.prevent="subirArchivo">

    <div class="text-sm pb-2">
        Archivo de ejemplo para la importación 
        <a href="{{ asset('assets') }}/imports/Planificacion.txt" download>
            aquí
        </a>
    </div>
        
    <div class="input-group input-group-static mt-3">
        <label>Archivo</label>
        <input type="file" wire:model="file" class="form-control"/>
    </div>
    @error('file')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <br/>

    <div class="form-check form-switch">
        <input wire:model="remplazar" class="form-check-input" type="checkbox" >
        <label class="form-check-label">Remplazar datos actuales</label>
    </div>

    <div class="text-center">
        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Importar</button>
    </div>
</form>
