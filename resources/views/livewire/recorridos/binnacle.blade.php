<div class="container-fluid py-4">

    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Bitacora diaria</h6>
            </div>
        </div>
        <div class="card-body px-4 pb-2">
            
            <p class="my-2 text-muted">Puede realizar busquedas personalizadas de la bitacora</p>

            <div class="input-group input-group-static mb-5">
                <input type="text" wire:model="busqueda" placeholder="Nombre del móvil o chofer" class="form-control"/>
            </div>

            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-hover table-sm">
                    <thead>
                        <tr>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Recorrido</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Movil</th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Chofer</th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Punto Control y Sensor</th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Horario</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $recorridos as $recorrido )
                        <tr>
                            <td>
                                {{ $recorrido->id }}
                            </td>
                            <td>
                                {{ $recorrido->movil_nombre }} ({{ $recorrido->movil_chapa }})
                            </td>
                            <td>
                                {{ $recorrido->choferes_nombre }} ({{ $recorrido->choferes_documento }})
                            </td>
                            <td>
                                {{ $recorrido->puntos_nombre }} ({{ $recorrido->sensores_nombre }})
                            </td>
                            <td>
                                {{ $recorrido->inicio }} -> {{ $recorrido->fin }}
                            </td>
                            <td>
                                <button
                                    onclick="if(confirm('¿Seguro que desea eliminar este recorrido?')) { @this.eliminarRecorrido({{ $recorrido->id }}) }"
                                    class="btn btn-danger m-0"
                                >
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="100" class="align-middle text-center">Sin datos</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
           

        </div>
    </div>

</div>
