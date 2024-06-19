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
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Historial de cambios de la Planificación {{ $plan->id }} del {{ $plan->fecha }}</h6>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('planesList') }}" role="button" class="btn btn-secondary m-0">Regresar</a>
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
                                            Usuarios Actualizador</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha y hora de actualización</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tipo de actualización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @forelse( $plan->planHistory as $line )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$line->users->name}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$line->created_at}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$line->tipo}} </p>
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
