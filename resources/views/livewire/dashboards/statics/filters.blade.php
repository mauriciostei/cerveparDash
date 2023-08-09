<tr>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropSitios" data-bs-toggle="dropdown" aria-expanded="false"> Tiers </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropSitios">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllTiers" wire:change="cambiarTodosTiers">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            @foreach($tiers as $item)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" wire:model="selectedTiers">
                        <label class="form-check-label"> {{$item->nombre}} </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </th>

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

    
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropOL" data-bs-toggle="dropdown" aria-expanded="false"> O.L. </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropOL">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllOL" wire:change="cambiarTodosOL">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            @foreach($ol as $item)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" wire:model="selectedOL">
                        <label class="form-check-label"> {{$item->nombre}} </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropChoferes" data-bs-toggle="dropdown" aria-expanded="false"> Chofer </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropChoferes">
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" wire:model="selectAllChoferes" wire:change="cambiarTodosChoferes">
                    <label class="form-check-label"> Seleccionar Todo </label>
                </div>
            </li>
            @foreach($choferes as $item)
                <li class="dropdown-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" wire:model="selectedChoferes">
                        <label class="form-check-label"> {{$item->nombre}} </label>
                    </div>
                </li>
            @endforeach
        </ul>
    </th>


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
                    <input class="form-check-input" type="checkbox" value="No Tratada" wire:model="selectedEstados">
                    <label class="form-check-label"> No Tratada </label>
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

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Jornada Lab / TMA </th>
</tr>