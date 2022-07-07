<div wire:poll.1000ms>
    <div class="container-fluid py-4">

        <div class="row">
            {{-- Primera caja T1 --}}
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Moviles <span class="font-weight-bolder"> T1 </span> </p>
                            <h4 class="mb-0"> {{$t1['total'] }} </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div>
                            On Time: <span class="text-success text-sm font-weight-bolder"> {{$t1['OnTime'] }} </span>
                        </div>
                        <div>
                            Out of Time: <span class="text-danger text-sm font-weight-bolder"> {{$t1['OutOfTime'] }} </span>
                        </div>
                    </div>

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> {{$t1['%'] }}% </span>de cumplimiento</p>
                    </div>
                </div>
            </div>

            {{-- Segunda Caja T2 --}}
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Moviles <span class="font-weight-bolder"> T2 </span> </p>
                            <h4 class="mb-0"> {{$t2['total'] }} </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-body">
                        <div>
                            On Time: <span class="text-success text-sm font-weight-bolder"> {{$t2['OnTime'] }} </span>
                        </div>
                        <div>
                            Out of Time: <span class="text-danger text-sm font-weight-bolder"> {{$t2['OutOfTime'] }} </span>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"> {{$t2['%'] }}% </span>de cumplimiento</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-grafica shadow border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="accuracy-chart" class="chart-canvas" height="80"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Accuracy de Camaras</h6>
                        <p class="text-sm ">Moviles captados segun planificacion</p>
                        <p class="text-sm ">Planificado: {{$acuraccy[0]->plan}}, Pendiente: {{$acuraccy[0]->plan -$acuraccy[0]->ejecutado}}</p>
                        {{-- <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Recien actualizada</p>
                        </div> --}}
                    </div>
                </div>
            </div>


        </div>



        <div class="row mt-4">

            {{-- Tabla de datos --}}
            <div class="col-xl-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-xl-10">
                                <h6>Moviles circulantes</h6>
                            </div>
                            <div class="col-xl-2">
                                <a wire:click.prevent="historial" class="btn btn-success p-2">Historial</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 m-2">
                        <div class="table-responsive">

                            <table class="table table-sm align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Hora Inicio </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Movil </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Sitio </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Duracion </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Target </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Estado </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recorridos  as $r)
                                        <tr>
                                            <td> {{explode(' ',$r->inicio)[1]}} </td>
                                            <td> {{$r->moviles->nombre}} </td>
                                            <td> {{$r->puntos->nombre}} </td>
                                            <td> {{$this->difTime($r->inicio)}} </td>
                                            <td> {{explode(' ',$r->target)[1]}} </td>
                                            <td>
                                                @if($r->estado == 'OnTime')
                                                    <span class="text-success">{{$r->estado}}</span>
                                                @elseif($r->estado == 'OutOfTime')
                                                    <span class="text-danger">{{$r->estado}}</span>
                                                @else
                                                    <span class="text-warning">{{$r->estado}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Tabla vacia, esperando datos...</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-md-0 mb-4">
                {{-- Lineas de tiempo --}}
                <div class="row">
                    
                    {{-- Tiempo T1 --}}
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6>{{$tiers->find(1)->nombre}}, Viaje: {{$t1Viaje}} </h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">

                                    @forelse($tiers->find(1)->puntos as $punto)
                                        @if($punto->pivot->viaje == $t1Viaje)
                                            <div class="timeline-block mb-3">
                                                <span class="timeline-step">
                                                    <i class="material-icons text-primary text-gradient">alt_route</i>
                                                </span>
                                                <div class="timeline-content">
                                                    <h6 class="text-dark text-sm font-weight-bold mb-0"> {{$punto->nombre}}: {{$punto->pivot->target}}
                                                    </h6>
                                                    <div class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                        <div>On Time: <span class="text-success">
                                                            {{$recorridos->where('tiers_id', 1)->where('viaje', $t1Viaje)->where('estado', 'OnTime')->where('puntos_id', $punto->id)->count()}}    
                                                        </span> </div>
                                                        <div>Out Of Time: <span class="text-danger">
                                                            {{$recorridos->where('tiers_id', 1)->where('viaje', $t1Viaje)->where('estado', 'OutOfTime')->where('puntos_id', $punto->id)->count()}}      
                                                        </span> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div>Aun no existen rutas para este Tier</div>
                                    @endforelse
                                </div>
                                <button class="btn btn-success w-100" wire:click.prevent="cambiarViaje(1)">Cambiar Viaje </button>
                                {{-- <hr class="dark horizontal my-0">
                                <br/>
                                <h6>Tiempo Total: <span class="text-success">00:23:00</span> </h6> --}}
                            </div>
                        </div>
                    </div>

                    {{-- Tiempo T2 --}}
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="card h-100">
                            <div class="card-header pb-0">
                                <h6>{{$tiers->find(2)->nombre}}, Viaje: {{$t2Viaje}} </h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="timeline timeline-one-side">

                                    @forelse($tiers->find(2)->puntos as $punto)
                                        @if($punto->pivot->viaje == $t2Viaje)
                                            <div class="timeline-block mb-3">
                                                <span class="timeline-step">
                                                    <i class="material-icons text-primary text-gradient">alt_route</i>
                                                </span>
                                                <div class="timeline-content">
                                                    <h6 class="text-dark text-sm font-weight-bold mb-0"> {{$punto->nombre}}: {{$punto->pivot->target}}
                                                    </h6>
                                                    <div class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                        <div>On Time: <span class="text-success">
                                                            {{$recorridos->where('tiers_id', 2)->where('viaje', $t2Viaje)->where('estado', 'OnTime')->where('puntos_id', $punto->id)->count()}}    
                                                        </span> </div>
                                                        <div>Out Of Time: <span class="text-danger">
                                                            {{$recorridos->where('tiers_id', 2)->where('viaje', $t2Viaje)->where('estado', 'OutOfTime')->where('puntos_id', $punto->id)->count()}}      
                                                        </span> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        <div>Aun no existen rutas para este Tier</div>
                                    @endforelse
                                </div>
                                <button class="btn btn-success w-100" wire:click.prevent="cambiarViaje(2)">Cambiar Viaje </button>
                                {{-- <hr class="dark horizontal my-0">
                                <br/>
                                <h6>Tiempo Total: <span class="text-success">00:23:00</span> </h6> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>