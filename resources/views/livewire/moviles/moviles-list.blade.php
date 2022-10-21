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
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Móviles</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('moviles_crear')
                                    <a href="{{ route('movilesForm', ['id' => 0]) }}" class="btn btn-secondary">
                                        <i class="material-icons opacity-10"> add </i> Nuevo
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">


                        <div class="input-group input-group-static">
                            <input type="text" wire:model="nombre" placeholder="Nombre móvil" class="form-control"/>
                        </div>

                        <br/>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Movil</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tier</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estado</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $moviles as $movil )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$movil->chapa}} </p>
                                            <p class="text-xs text-secondary mb-0">Nombre: {{$movil->nombre}}
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$movil->tiers->nombre}} </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{$movil->activo === true ? 'bg-gradient-success' : 'bg-gradient-warning'}}">
                                                {{$movil->activo === true ? 'Activo' : 'Inactivo'}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @can('moviles_editar')
                                            <a href="{{ route('movilesForm', ['id' => $movil->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Movil">
                                                Editar
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5" class="align-middle text-center">Sin datos</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                            <br/>
                            {{$moviles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
