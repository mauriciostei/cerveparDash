<form wire:submit.prevent="save">

    <div class="input-group input-group-static mt-3">
        <label>Problemas</label>
        <select class="form-control" wire:model="alerta.problemas_id">
            <option disabled>--Selecciones un Problema--</option>
            @forelse($problemas as $p)
                <option value="{{$p->id}}"> {{$p->nombre}} </option>
            @empty
            @endforelse
        </select>
    </div>
    @error('alerta.problemas_id')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <div class="input-group input-group-static mt-3">
        <label>Observaciones</label>
        <textarea class="form-control" wire:model="alerta.observaciones"></textarea>
    </div>
    @error('alerta.observaciones')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <div class="text-center">
        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Iniciar Trabajos</button>
    </div>
</form>
