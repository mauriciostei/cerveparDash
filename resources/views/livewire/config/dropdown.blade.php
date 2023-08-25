<div>
    <a class="dropdown-toggle" role="button" id="drop{{$titulo}}" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"> {{$titulo}} </a>
    <ul class="dropdown-menu bg-dark" aria-labelledby="drop{{$titulo}}">
        <div class="list-group list-group-flush overflow-auto shadow" style="max-height: 300px;">
            <li class="list-group-item flex flex-col justify-content-around">
                <button class="btn btn-primary p-1 m-0" wire:click="alterar(true)">Seleccionar todo</button>
                <button class="btn btn-primary p-1 m-0 ms-2" wire:click="alterar(false)">Seleccionar ninguno</button>
            </li>
            @foreach($datos as $item)
                <label class="list-group-item p-1">
                    <input class="form-check-input me-2" type="checkbox" wire:model="selected.{{$item->id}}" wire:change="modificacion"> {{$item->nombre}}
                </label>
            @endforeach
        </div>
    </ul>
</div>
