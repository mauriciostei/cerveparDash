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
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Choferes</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('create', App\Models\Choferes::class)
                                    <a href="{{ route('choferesForm', ['id' => 0]) }}" class="btn btn-secondary">
                                        <i class="fa-solid fa-plus"></i> Nuevo
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">

                        <div class="input-group input-group-static mb-3">
                            <label class="text-muted text-xs">Búsqueda de chofer</label>
                            <input type="text" wire:model="nombre" placeholder="Nombre del Chofer" class="form-control"/>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Chofer</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estado</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $choferes as $chofer )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$chofer->nombre}} </p>
                                            <p class="text-xs text-secondary mb-0">Documento: {{number_format($chofer->documento)}}
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{$chofer->activo === true ? 'bg-gradient-success' : 'bg-gradient-warning'}}">
                                                {{$chofer->activo === true ? 'Activo' : 'Inactivo'}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @can('update', $chofer)
                                            <a href="{{ route('choferesForm', ['id' => $chofer->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Chofer">
                                                Editar
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
                            {{$choferes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
