<tr>
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        @livewire('config.dropdown', [ 'arreglo' => $tiers, 'titulo' => 'Tiers' ])
    </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Hora Inicio </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        @livewire('config.dropdown', [ 'arreglo' => $moviles, 'titulo' => 'Móviles' ])
    </th>

    
    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        {{-- @livewire('config.dropdown', [ 'arreglo' => $ol, 'titulo' => 'O.L.' ]) --}}
        O.L.
    </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        @livewire('config.dropdown', [ 'arreglo' => $choferes, 'titulo' => 'Chofer' ])
    </th>


    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        @livewire('config.dropdown', [ 'arreglo' => $puntos, 'titulo' => 'Sitio' ])
    </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Duración </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center"> Target Llegada </th>

    <th class="text-uppercase text-secondary text-sm font-weight-bolder text-center">
        <a class="dropdown-toggle" role="button" id="dropEstados" data-bs-toggle="dropdown" aria-expanded="false"> Estado </a>
        <ul class="dropdown-menu bg-dark" aria-labelledby="dropEstados">
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