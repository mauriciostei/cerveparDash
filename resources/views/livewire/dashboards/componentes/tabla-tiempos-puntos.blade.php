<div wire:poll.1000ms class="card mt-4 mt-lg-0">
    <div class="card-header p-3 pt-2">
        <div class="text-end pt-1">
            <p class="text-lg mb-0 text-capitalize">Tiempos <span class="font-weight-bolder"> Medios por Zona </span> </p>
        </div>
    </div>
    <div class="card-body pt-2 pb-2">
        <table class="table table-hover table-sm mt-2">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th>Tier 1</th>
                    <th>Tier 2</th>
                    <th>Promedio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($puntos as $item)
                    <tr>
                        <td> {{$item->nombre}} </td>
                        <td> {{date('H:i', strtotime($item->t1))}} </td>
                        <td> {{date('H:i', strtotime($item->t2))}} </td>
                        <td> {{date('H:i', strtotime($item->general))}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>