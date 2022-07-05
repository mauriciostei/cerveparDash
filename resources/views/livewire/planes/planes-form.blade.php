<div class="">
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12 col-lg-6">

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


            <div class="col-12 col-lg-6">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Datos Actuales</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        <div>
                            <p>Viajes de la fecha {{$plan->fecha}} </p>
        
                            <table class="table align-items-center mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Movil</th>
                                        <th>Chofer</th>
                                        <th>Viaje</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plan->moviles as $m)
                                        <tr>
                                            <td> {{$m->nombre}} </td>
                                            <td> {{$choferes->find($m->pivot->choferes_id)->nombre}} </td>
                                            <td> {{$m->pivot->viaje}} </td>
                                            <td>
                                                <button wire:click.prevent="borrar({{$m->id}}, {{$m->pivot->choferes_id}}, {{$m->pivot->viaje}})" class="btn btn-success">Eliminar</button>
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
