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
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Operadores Logísticos</h6>
                                </div>
                                <div class="col-lg-2">
                                    @can('operadoras_crear')
                                    <a href="{{ route('operadorasForm', ['id' => 0]) }}" class="btn btn-secondary">
                                        <i class="material-icons opacity-10"> add </i> Nuevo
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
                                            Operador Logístico</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Estado
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $operadoras as $item )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$item->nombre}} </p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            @if($item->activo)
                                                <span class="badge badge-sm bg-gradient-success">Activo</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            @can('operadoras_editar')
                                            <a href="{{ route('operadorasForm', ['id' => $item->id]) }}"
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
                            {{ $operadoras->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
