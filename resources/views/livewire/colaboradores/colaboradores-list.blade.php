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
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Colaboradores</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('create', App\Models\Colaboradores::class)
                                    <a href="{{ route('colaboradoresForm', ['id' => 0]) }}" class="btn btn-secondary">
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
                                            Colaborador</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Documento</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $colaboradores as $item )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$item->nombre}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{number_format($item->cedula)}} </p>
                                        </td>
                                        <td class="align-middle">
                                            @can('update', $item)
                                            <a href="{{ route('colaboradoresForm', ['id' => $item->id]) }}"
                                                class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Editar">
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
                            <br/>
                            {{ $colaboradores->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
