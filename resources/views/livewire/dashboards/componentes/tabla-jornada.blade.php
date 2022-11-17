<div wire:poll.1000ms class="card w-100 shadow">
    <div class="card-body table-responsive p-3">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Tiers</th>
                    <th>Choferes</th>
                    <th class="text-center">TML</th>
                    <th class="text-center">TR</th>
                    <th class="text-center">T. Físico</th>
                    <th class="text-center">T. Financiero</th>
                    <th class="text-center">TI</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jornada as $item)
                    <tr>
                        <td> {{$item->tiers_nombre}} </td>
                        <td> {{$item->chofer_nombre}} </td>
                        <td class="text-center"> {{$item->tml}} </td>
                        <td class="text-center"> {{$item->tr}} </td>
                        <td class="text-center"> {{$item->tfisico}} </td>
                        <td class="text-center"> {{$item->tfinanciero}} </td>
                        <td class="text-center"> {{$item->tmi}} </td>
                        <td class="text-center"> {{$item->ttotal}} </td>
                    </tr>
                @empty
                    <tr>
                        <th class="text-center text-muted" colspan="100">Sin registros!</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
