<div wire:poll.1000ms class="card mt-4 mt-lg-0">
    <div class="card-header p-3 pt-2">
        <div class="text-end pt-1">
            <p class="text-lg mb-0 text-capitalize">Tiempos <span class="font-weight-bolder"> Medios </span> </p>
        </div>
    </div>
    <div class="card-body pt-2 pb-2 table-responsive">
        <table class="table table-hover table-sm mt-2">
            <thead>
                <tr>
                    <th>Tier</th>
                    <th>TML</th>
                    <th>TI</th>
                    <th>TMR</th>
                    <th>Jornada Laboral</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tm as $item)
                    <tr>
                        <td> Tier {{$item->id}} </td>
                        <td> {{date('H:i', strtotime($item->tml))}} </td>
                        <td> {{date('H:i', strtotime($item->tmi))}} </td>
                        <td> {{date('H:i', strtotime($item->tmr))}}  </td>
                        <td> {{date('H:i', strtotime($item->jornada))}}  </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Promedio:</th>
                    <th> {{date('H:i', strtotime($GlobalTM[0]->tml))}}  </th>
                    <th> {{date('H:i', strtotime($GlobalTM[0]->tmi))}}  </th>
                    <th> {{date('H:i', strtotime($GlobalTM[0]->tmr))}}  </th>
                    <td> {{date('H:i', strtotime($GlobalTM[0]->jornada))}}  </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>