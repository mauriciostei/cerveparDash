<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Tiers</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('tiers_crear')
                                    <a href="{{ route('tiersForm', ['id' => 0]) }}" class="btn btn-secondary">
                                        <i class="fa-solid fa-plus"></i> Nuevo
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tiers</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Puntos</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estado</th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $tiers as $tier )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$tier->nombre}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$tier->puntos->count()}} </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{$tier->activo === true ? 'bg-gradient-success' : 'bg-gradient-warning'}}">
                                                {{$tier->activo === true ? 'Activo' : 'Inactivo'}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @can('tiers_editar')
                                            <a href="{{ route('tiersForm', ['id' => $tier->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Tier">
                                                Editar
                                            </a>
                                            @endcan
                                        </td>
                                        <td class="align-middle">
                                            @can('tiers_editar')
                                            <a href="{{ route('tiersViajeForm', ['id' => $tier->id, 'viaje' => 1]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Tier">
                                                Viaje 1
                                            </a>
                                            @endcan
                                        </td>
                                        <td class="align-middle">
                                            @can('tiers_editar')
                                            <a href="{{ route('tiersViajeForm', ['id' => $tier->id, 'viaje' => 2]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Tier">
                                                Viaje 2
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                        <tr>
                                            <td colspan="3" class="align-middle text-center">Sin datos</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
