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
                        {{-- <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Ultima Actualizacion: {{now()}} </p>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-grafica shadow border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="desvio_medio" class="chart-canvas" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Tiempo medio de desvió por punto de control</h6>
                        <p class="text-sm ">Expresado en minutos se ve el tiempo de desvió medio de cada Movil</p>
                        {{-- <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Ultima Actualizacion: {{now()}} </p>
                        </div> --}}
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
                        {{-- <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Ultima Actualizacion: {{now()}} </p>
                        </div> --}}
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
                        {{-- <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                            <p class="mb-0 text-sm">Ultima Actualizacion: {{now()}} </p>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>