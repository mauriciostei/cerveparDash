<div class="">
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Causas Raíz</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('create', App\Models\Causas::class)
                                    <a href="{{ route('causasRaizForm', ['id' => 0]) }}" class="btn btn-secondary">
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
                                            Causa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Activo</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $causasRaiz as $causa )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$causa->nombre}} </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{$causa->activo === true ? 'bg-gradient-success' : 'bg-gradient-warning'}}">
                                                {{$causa->activo === true ? 'Activo' : 'Inactivo'}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @can('update', $causa)
                                            <a href="{{ route('causasRaizForm', ['id' => $causa->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Problema">
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
                            {{$causasRaiz->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Causas Generales</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('create', App\Models\Causas::class)
                                    <a href="{{ route('causasForm', ['id' => 0]) }}" class="btn btn-secondary">
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
                                            Causa</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Activo</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $causas as $causa )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$causa->nombre}} </p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{$causa->activo === true ? 'bg-gradient-success' : 'bg-gradient-warning'}}">
                                                {{$causa->activo === true ? 'Activo' : 'Inactivo'}}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @can('update', $causa)
                                            <a href="{{ route('causasForm', ['id' => $causa->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar Problema">
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
                            {{$causas->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
