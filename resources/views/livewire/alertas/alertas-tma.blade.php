<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Alertas TMA</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">

                <div class="table-responsive p-0">
                    <table class="table table-hover align-items-center mb-0">
                        <tr>
                            <td>Movil en retraso:</td>
                            <td> {{$alerta->recorridos->moviles->nombre}} - {{$alerta->recorridos->moviles->chapa}} </td>
                        </tr>
                        <tr>
                            <td>Hora de inicio:</td>
                            <td> {{$alerta->recorridos->inicio}}</td>
                        </tr>
                        <tr>
                            <td>Fin esperado:</td>
                            <td> {{$alerta->created_at}}</td>
                        </tr>
                    </table>
                </div>

                <form wire:submit.prevent="save">

                    <div class="input-group input-group-static mt-3">
                        <label>Causa Raíz</label>
                        <select class="form-control" wire:model="alerta.causa_raizs_id">
                            <option selected>--Selecciones una Causa--</option>
                            @forelse($causaRaiz as $p)
                                <option value="{{$p->id}}"> {{$p->nombre}} </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    @error('alerta.causa_raizs_id')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <div class="input-group input-group-static mt-3">
                        <label>Causa General</label>
                        <select class="form-control" wire:model="alerta.causas_id">
                            <option selected>--Selecciones una Causa--</option>
                            @forelse($causas as $p)
                                <option value="{{$p->id}}"> {{$p->nombre}} </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    @error('alerta.causas_id')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                
                    <div class="input-group input-group-static mt-3">
                        <label>Observaciones</label>
                        <textarea class="form-control" wire:model="alerta.observaciones"></textarea>
                    </div>
                    @error('alerta.observaciones')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                
                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Anular Alerta</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
