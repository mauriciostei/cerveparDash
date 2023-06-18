<div class="container-fluid py-4">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Aprobación del Sistema</h6>
            </div>
        </div>
        <div class="card-body px-4 pb-2">

            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped">
                    <tr>
                        <td>Tipo de Solicitud:</td>
                        <td> {{$aprobacion->tipo}} </td>
                    </tr>
                    <tr>
                        <td>Fecha de Solicitud:</td>
                        <td> {{$aprobacion->created_at}} </td>
                    </tr>
                    <tr>
                        <td>Usuario Solicitante:</td>
                        <td> {{$aprobacion->users->name}} </td>
                    </tr>
                </table>
            </div>

            <div class="mx-2">
                <div>Observaciones:</div>
                <div> {{$aprobacion->observacion}} </div>
            </div>

            <div class="mx-2 my-2">
                <h4 class="text-center">Detalle del Cambio</h4>
                @livewire("aprobaciones.vista.$aprobacion->vista", ['id' => $aprobacion->aprobacion_id])
            </div>

            @error('aprobacion.observacion_resolucion')
                <div class='text-danger inputerror px-3'>{{ $message }} </div>
            @enderror

            <div class="input-group input-group-sm input-group-static mb-5 px-3">
                <label>Observaciones Finales</label>
                <textarea class="form-control" wire:model="aprobacion.observacion_resolucion"></textarea>
            </div>

            <div class="d-flex flex-row justify-content-between mx-4 mt-3">
                <button class="btn btn-secondary" wire:click.prevent="rechazar">Rechazar</button>
                <button class="btn btn-success" wire:click.prevent="aprobar">Aprobar</button>
            </div>

        </div>
    </div>
</div>
