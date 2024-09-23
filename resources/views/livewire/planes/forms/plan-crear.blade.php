<form wire:submit.prevent="agregar">
        
    <div class="input-group input-group-static mt-3">
        <label>Movil</label>
        <select class="form-control" wire:model="movil">
            <option value="0" disabled>Seleccione el Movil</option>
            @forelse($moviles as $m)
                <option value="{{$m->id}}"> {{$m->nombre}} </option>
            @empty
            @endforelse
        </select>
    </div>
    @error('movil')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <div class="input-group input-group-static mt-3">
        <label>Chofer</label>
        <select class="form-control" wire:model="chofer">
            <option value="0" disabled>Seleccione el Chofer</option>
            @forelse($choferes as $c)
                <option value="{{$c->id}}"> {{$c->nombre}} </option>
            @empty
            @endforelse
        </select>
    </div>
    @error('chofer')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <div class="input-group input-group-static mt-3">
        <label>Viaje</label>
        <input type="number" wire:model="viaje" class="form-control"/>
    </div>
    @error('viaje')
        <p class='text-danger inputerror'>{{ $message }} </p>
    @enderror

    <br/>

    <div class="text-center">
        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Añadir</button>
    </div>
</form>
