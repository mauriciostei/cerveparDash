<div class="">
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12 col-lg-4">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Agregar datos</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
        
                        <livewire:planes.forms.plan-crear id="{{$plan->id}}" />
                        
                    </div>
                </div>
        
        
                <br/>
        
        
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Importar datos</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
        
                        <livewire:planes.forms.plan-importar id="{{$plan->id}}" />
                        
                    </div>
                </div>

            </div>


            <div class="col-12 col-lg-8">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3 d-flex flex-row justify-content-around">
                            <h6 class="text-white text-capitalize ps-3">Datos Actuales</h6>
                            <button class="btn btn-secondary shadow mb-0 mt-0" wire:click.prevent="exportar">Exportar</button>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <div>
                            <p>Viajes de la fecha: {{$plan->fecha}} </p>
                            <p>Actualizado al: {{$plan->ultima_actualizacion}} </p>
        
                            <table class="table align-items-center mb-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Movil</th>
                                        <th>Chofer</th>
                                        <th>Operador Logístico</th>
                                        <th>Ayudante</th>
                                        <th>Viaje</th>
                                        <th>Captado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plan->moviles->sortByDesc('tiers_id') as $m)
                                        <tr>
                                            <td> {{$m->nombre}} </td>
                                            <td> {{$choferes->find($m->pivot->choferes_id)->nombre}} </td>
                                            <td> @if($choferes->find($m->pivot->choferes_id)->operadoras) {{$choferes->find($m->pivot->choferes_id)->operadoras->nombre}} @endif </td>
                                            <td> @if($choferes->find($m->pivot->choferes_id)->ayudantes) {{$choferes->find($m->pivot->choferes_id)->ayudantes->nombre}} @endif </td>
                                            <td> {{$m->pivot->viaje}} </td>
                                            <td>
                                                @if($recorridos->where('moviles_id', $m->id)->where('choferes_id', $m->pivot->choferes_id)->where('viaje', $m->pivot->viaje)->first())
                                                    OK
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click.prevent="borrar({{$m->id}}, {{$m->pivot->choferes_id}}, {{$m->pivot->viaje}})" class="btn btn-success btn-sm">Eliminar</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Sin datos para mostrar</td>
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
