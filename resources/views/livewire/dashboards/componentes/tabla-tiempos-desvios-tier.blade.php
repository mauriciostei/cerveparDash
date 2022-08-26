<div wire:poll.1000ms class="d-flex flex-column flex-lg-row justify-content-between mt-3">

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