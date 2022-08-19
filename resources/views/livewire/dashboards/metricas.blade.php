<div wire:poll.1000ms>
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">filter_alt</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Filtros en <span class="font-weight-bolder"> Métricas </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-2">

                        <div class="row">

                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.1" class="form-check-input" type="checkbox" >
                                    <label class="form-check-label">T1</label>
                                </div>
                            </div>
                            
                            <div class="col-6 col-lg-1">
                                <div class="form-check form-switch">
                                    <input wire:model="tiers.2" class="form-check-input" type="checkbox" >
                                    <label class="form-check-label">T2</label>
                                </div>
                            </div>

                            <div class="col-6 col-lg-5">
                                <div class="input-group input-group-sm input-group-static">
                                    <label>Desde</label>
                                    <input type="date" wire:model="desde" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-6 col-lg-5">
                                <div class="input-group input-group-sm input-group-static">
                                    <label>Hasta</label>
                                    <input type="date" wire:model="hasta" class="form-control"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-12 col-lg-6 mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-grafica shadow border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="ingreso_moviles" class="chart-canvas" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Ingreso de móviles por hora</h6>
                        <p class="text-sm ">Móviles que ingresaron según su rango horario</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-4 mb-3">
                <div class="card mt-4 mt-lg-0">
                    <div class="card-header p-3 pt-2">
                        {{-- <div class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div> --}}
                        <div class="text-end pt-1">
                            <p class="text-lg mb-0 text-capitalize">Tiempos <span class="font-weight-bolder"> Medios </span> </p>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">
                        <table class="table table-hover table-sm mt-2">
                            <thead>
                                <tr>
                                    <th>Tier</th>
                                    <th>TMI</th>
                                    <th>TMR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tm as $item)
                                    <tr>
                                        <td> Tier {{$item->id}} </td>
                                        <td> {{date('H:i', strtotime($item->tmi))}} </td>
                                        <td> {{date('H:i', strtotime($item->tmr))}}  </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Promedio:</th>
                                    <th> {{date('H:i', strtotime($GlobalTM[0]->tmi))}}  </th>
                                    <th> {{date('H:i', strtotime($GlobalTM[0]->tmr))}}  </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-1">

            <div class="col-12 col-lg-6 mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-grafica shadow border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="top_desvios" class="chart-canvas" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Top 5 de desvíos</h6>
                        <p class="text-sm ">Expresado en minutos se visualizan los móviles con mayor promedio de desvió</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-grafica shadow border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="cantidad_desvios" class="chart-canvas" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Anomalías por hora</h6>
                        <p class="text-sm ">Cantidad de anomalías que se visualizan en los distintos rangos horarios</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex flex-column flex-lg-row justify-content-between mt-3">

            <div class="card w-100 w-lg-32">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Tier 1</th>
                            </tr>
                            <tr>
                                <th>Zona</th>
                                <th>OOT</th>
                                <th>Captadas</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resumenPuntos as $item)
                                <tr>
                                    <td> {{$item->nombre}} </td>
                                    <td class="text-center"> {{$item->oot_t1}} </td>
                                    <td class="text-center"> {{$item->cantidad_t1}} </td>
                                    {{$this->getHTML($item->oot_t1, $item->cantidad_t1)}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card w-100 w-lg-32">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Tier 2</th>
                            </tr>
                            <tr>
                                <th>Zona</th>
                                <th>OOT</th>
                                <th>Captadas</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resumenPuntos as $item)
                                <tr>
                                    <td> {{$item->nombre}} </td>
                                    <td class="text-center"> {{$item->oot_t2}} </td>
                                    <td class="text-center"> {{$item->cantidad_t2}} </td>
                                    {{$this->getHTML($item->oot_t2, $item->cantidad_t2)}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card w-100 w-lg-32">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">Tier 1 + Tier 2</th>
                            </tr>
                            <tr>
                                <th>Zona</th>
                                <th>OOT</th>
                                <th>Captadas</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resumenPuntos as $item)
                                <tr>
                                    <td> {{$item->nombre}} </td>
                                    <td class="text-center"> {{$item->oot_t1 + $item->oot_t2}} </td>
                                    <td class="text-center"> {{$item->cantidad_t1 + $item->cantidad_t2}} </td>
                                    {{$this->getHTML($item->oot_t1 + $item->oot_t2, $item->cantidad_t1 + $item->cantidad_t2)}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="row mt-1">
            <div class="col-12 mt-4 mb-3">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex flex-row justify-content-between">
                            <h5>Métrica de desvió por móvil</h5>
                            <button wire:click.prevent="descargar" class="btn btn-primary shadow">Descargar</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th colspan="7" class="text-center">Porcentaje de OOT por zona</th>
                                        <th colspan="3" class="text-center">Totales</th>
                                    </tr>
                                    <tr>
                                        <th>Movil</th>
                                        <th>En Ruta</th>
                                        <th>Control 1</th>
                                        <th>Control 2</th>
                                        <th>Envases</th>
                                        <th>Fin Envases</th>
                                        <th>Descarga</th>
                                        <th>Espera</th>
                                        <th>Total de veces OOT</th>
                                        <th>Total de veces Captado</th>
                                        <th>Porcentaje total OOT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resumenMoviles as $item)
                                        <tr>
                                            <td> {{$item->nombre}} </td>
                                            {{$this->getHTML($item->cantidad_oot_ruta, $item->cantidad_ruta)}}
                                            {{$this->getHTML($item->cantidad_oot_control1, $item->cantidad_control1)}}
                                            {{$this->getHTML($item->cantidad_oot_control2, $item->cantidad_control2)}}
                                            {{$this->getHTML($item->cantidad_oot_envases, $item->cantidad_envases)}}
                                            {{$this->getHTML($item->cantidad_oot_fin_envases, $item->cantidad_fin_envases)}}
                                            {{$this->getHTML($item->cantidad_oot_descarga, $item->cantidad_descarga)}}
                                            {{$this->getHTML($item->cantidad_oot_espera, $item->cantidad_espera)}}
                                            <td class="text-center"> {{$item->oot}} </td>
                                            <td class="text-center"> {{$item->cantidad}} </td>
                                            {{$this->getHTML($item->oot, $item->cantidad)}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>