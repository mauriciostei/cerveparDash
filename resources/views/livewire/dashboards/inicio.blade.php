<div wire:poll.1000ms>
    <div class="container-fluid py-4">


        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        {{-- Caja resumen T1 --}}
                        <div class="card mt-4 mt-lg-0">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">weekend</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-lg mb-0 text-capitalize">Móviles <span class="font-weight-bolder"> T1 </span> </p>
                                    <h4 class="mb-0 text-lg"> {{$t1['total'] }} </h4>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="text-lg">
                                    On Time: <span class="text-success text-lg font-weight-bolder"> {{$t1['OnTime'] }} </span>
                                </div>
                                <div class="text-lg">
                                    Out of Time: <span class="text-danger text-lg font-weight-bolder"> {{$t1['OutOfTime'] }} </span>
                                </div>
                            </div>
        
                            <div class="card-footer p-3 pt-0">
                                <p class="mb-0 text-lg"><span class="text-success text-lg font-weight-bolder"> {{$t1['%'] }}% </span>de cumplimiento</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        {{-- Caja Resumen T2 --}}
                        <div class="card mt-4 mt-lg-0">
                            <div class="card-header p-3 pt-2">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                    <i class="material-icons opacity-10">person</i>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="text-lg mb-0 text-capitalize">Móviles <span class="font-weight-bolder"> T2 </span> </p>
                                    <h4 class="mb-0 text-lg"> {{$t2['total'] }} </h4>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="text-lg">
                                    On Time: <span class="text-success text-lg font-weight-bolder"> {{$t2['OnTime'] }} </span>
                                </div>
                                <div class="text-lg">
                                    Out of Time: <span class="text-danger text-lg font-weight-bolder"> {{$t2['OutOfTime'] }} </span>
                                </div>
                            </div>
                            <div class="card-footer p-3 pt-0">
                                <p class="mb-0 text-lg"><span class="text-success text-lg font-weight-bolder"> {{$t2['%'] }}% </span>de cumplimiento</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card mt-4 mt-lg-0">
                            <div class="card-body pb-0">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                      <div class="progress-percentage">
                                        <span class="text-sm font-weight-normal">{{round($acuraccy[0]->porcentaje,2)}}%</span>
                                      </div>
                                    </div>
                                    <div class="progress" style="height: 32px;">
                                        <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="{{$acuraccy[0]->porcentaje}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$acuraccy[0]->porcentaje}}%; height: 32px;"></div>
                                    </div>
                                </div>
                                <br/>
                                <h6 class="mb-0 text-lg">Accuracy de Cámaras</h6>
                                <p class="text-sm ">Móviles captados según planificación</p>
                            </div>
                            <div class="card-footer pr-3 pt-0 pb-1">
                                <p class="text-sm ">Planificado: {{$acuraccy[0]->plan}}, Pendiente: {{$acuraccy[0]->plan -$acuraccy[0]->ejecutado}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 mt-lg-3">
                    <div class="col">
                        {{-- Tabla de moviles en circulacion --}}
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-xl-10">
                                        <h6>Móviles circulantes</h6>
                                    </div>
                                    <div class="col-xl-2">
                                        <a wire:click.prevent="historial" class="btn btn-success p-1">Historial</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 m-2">
                                <div class="table-responsive">
        
                                    <table class="table table-sm align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Hora Inicio </th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Movil </th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Sitio </th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Duración </th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Target </th>
                                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center"> Estado </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recorridos  as $r)
                                                <tr>
                                                    <td class="text-secondary text-sm text-center"> {{explode(' ',$r->inicio)[1]}} </td>
                                                    <td class="text-secondary text-sm text-center"> {{$r->moviles->nombre}} </td>
                                                    <td class="text-secondary text-sm text-center"> {{$r->puntos->nombre}} </td>
                                                    <td class="text-secondary text-sm text-center"> {{$this->difTime($r->inicio)}} </td>
                                                    <td class="text-secondary text-sm text-center"> {{explode(' ',$r->target)[1]}} </td>
                                                    <td class="text-secondary text-sm text-center">
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
                                                    <td colspan="5">Tabla vacía, esperando datos...</td>
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
            <div class="col-12 col-lg-4">
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
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>