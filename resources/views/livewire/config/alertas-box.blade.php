<div wire:poll.1000ms>

    <ul class="list-group">
        @forelse($alertas as $al)
            <a class="list-group-item list-group-item-action" href="{{ route('alertasForm', ['id' => $al->id]) }}">
                <div class="d-flex py-1">
                    <div class="my-auto">
                        <i class="fa fa-bell opacity-10 me-3 text-2xl"></i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold"> {{$al->recorridos->moviles->nombre}} : {{$al->recorridos->choferes->nombre}} </span>
                            <br/>
                            Punto: <span class="font-weight-bold"> {{$al->recorridos->sensores->puntos->nombre}} </span>
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            {{$al->created_at}}
                        </p>
                    </div>
                </div>
            </a>
        @empty
            <li class="list-group-item text-success text-center font-weight-bold">No hay alertas pendientes</li>
        @endforelse
    </ul>

</div>