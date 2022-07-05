<form wire:submit.prevent="save">

    <div class="table-responsive p-0">
        <table class="table table-hover align-items-center mb-0">
            <tr>
                <td>Tarea iniciado:</td>
                <td> {{$alerta->inicio}}</td>
            </tr>
            <tr>
                <td>Problema Asignado:</td>
                <td> {{$alerta->problemas->nombre}}</td>
            </tr>
        </table>
    </div>

    @if($usuario->id == $authUser->id)

        <div class="input-group input-group-static mt-3">
            <label>Solucion</label>
            <select class="form-control" wire:model="alerta.soluciones_id">
                <option disabled>--Selecciones un Problema--</option>
                @forelse($soluciones as $s)
                    <option value="{{$s->id}}"> {{$s->nombre}} </option>
                @empty
                @endforelse
            </select>
        </div>
        @error('alerta.soluciones_id')
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
            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Resolver Anomalia</button>
        </div>

    @else
        <hr/>
        <div class="text-warning text-center text-bold">Tarea asignada para resolucion a: {{$usuario->name}} </div>
    @endif

</form>
