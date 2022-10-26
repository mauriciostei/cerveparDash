<tr>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Hora Inicio </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">

        <a class="dropdown-toggle" role="button" id="dropMoviles" data-bs-toggle="dropdown" aria-expanded="false"> Móvil </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropMoviles">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllMoviles" wire:change="cambiarTodosMoviles">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            @foreach($moviles as $item)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" wire:model="selectedMovil">
                        <label class="form-check-label"> {{$item->nombre}} </label>
                    </div>
                </li>
            @endforeach
        </ul>

    </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Chofer </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropSitios" data-bs-toggle="dropdown" aria-expanded="false"> Sitio </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropSitios">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllPuntos" wire:change="cambiarTodosPuntos">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            @foreach($puntos as $item)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" wire:model="selectedPuntos">
                        <label class="form-check-label"> {{$item->nombre}} </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Duración </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Target Llegada </th>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropEstados" data-bs-toggle="dropdown" aria-expanded="false"> Estado </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropEstados">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllEstados" wire:change="cambiarTodosEstados">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="OnTime" wire:model="selectedEstados">
                    <label class="form-check-label"> OnTime </label>
                </div>
            </li>
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Dismiss" wire:model="selectedEstados">
                    <label class="form-check-label"> Dismiss </label>
                </div>
            </li>
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="OutOfTime" wire:model="selectedEstados">
                    <label class="form-check-label"> OutOfTime </label>
                </div>
            </li>
        </ul>
    </th>
</tr>