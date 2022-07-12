<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Alertas</h6>
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
                            <td>Punto de control:</td>
                            <td> {{$alerta->recorridos->sensores->puntos->nombre}}</td>
                        </tr>
                        <tr>
                            <td>Hora de inicio:</td>
                            <td> {{$alerta->recorridos->inicio}}</td>
                        </tr>
                        <tr>
                            <td>Fin esperado:</td>
                            <td> {{$alerta->recorridos->target}}</td>
                        </tr>
                        <tr>
                            <td>Ponderación:</td>
                            <td> {{$alerta->recorridos->ponderacion}}</td>
                        </tr>
                    </table>
                </div>

                <hr/>

                @if(isset($alerta->users_id) && isset($alerta->problemas_id))
                    <livewire:alertas.resolucion id="{{$alerta->id}}"/>
                @else
                    <livewire:alertas.asignacion id="{{$alerta->id}}"/>
                @endif

            </div>
        </div>
    </div>
</div>
