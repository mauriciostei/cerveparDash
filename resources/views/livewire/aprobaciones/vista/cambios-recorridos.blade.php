<div class="">
    
    <h6>Generar nuevo Recorrido:</h6>
    
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover">
            <tr>
                <td>Movil:</td>
                <td> {{$cambioRecorrido->moviles->nombre}} ({{$cambioRecorrido->moviles->chapa}}) </td>
            </tr>
            <tr>
                <td>Chofer:</td>
                <td> {{$cambioRecorrido->choferes->nombre}} </td>
            </tr>
            <tr>
                <td>Punto:</td>
                <td> {{$cambioRecorrido->puntos->nombre}} </td>
            </tr>
            <tr>
                <td>Sensor:</td>
                <td> {{$cambioRecorrido->sensores->nombre}} </td>
            </tr>
            <tr>
                <td>Fecha y Hora:</td>
                <td> {{$cambioRecorrido->inicio}} </td>
            </tr>
        </table>
    </div>

</div>
