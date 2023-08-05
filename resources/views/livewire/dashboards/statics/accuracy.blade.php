<div class="card mt-4 mt-lg-0" wire:poll.1000ms>
    <div class="card-body pb-0">
        <div class="progress-wrapper">
            <div class="progress-info">
              <div class="progress-percentage">
                    <span class="text-sm font-weight-normal">{{round($porcentaje,2)}}%</span>
                </div>
            </div>
            <div class="progress" style="height: 32px;">
                    <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="{{$porcentaje}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$porcentaje}}%; height: 32px;"></div>
            </div>
        </div>
        <br/>
        <h6 class="mb-0 text-lg">Accuracy de Cámaras</h6>
        <p class="text-sm ">Móviles captados según planificación</p>
    </div>
    <div class="card-footer pr-3 pt-0 pb-1">
            <p class="text-sm ">Planificado: {{$plan}}, Pendiente: {{$plan - $ejecutado}}</p>
    </div>
</div>