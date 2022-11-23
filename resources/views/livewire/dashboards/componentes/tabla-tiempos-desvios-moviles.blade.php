<div wire:poll.1000ms class="card">
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
                        <th colspan="9" class="text-center">Porcentaje de OOT por zona</th>
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
                        <th>Liquidación</th>
                        <th>Caja</th>
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
                            {{$this->getHTML($item->cantidad_oot_liquidacion, $item->cantidad_liquidacion)}}
                            {{$this->getHTML($item->cantidad_oot_caja, $item->cantidad_caja)}}
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