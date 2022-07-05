<div wire:poll.1000ms>

    @forelse($alertas as $al)

        <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="{{ route('alertasForm', ['id' => $al->id]) }}">
                <div class="d-flex py-1">
                    <div class="my-auto">
                        <i class="material-icons opacity-10 me-3">notifications_active </i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                            Alerta Pendiente: <span class="font-weight-bold"> {{$al->recorridos->moviles->nombre}} </span>
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
        </li>

    @empty
        <div class="text-success text-center"> No hay alertas pendientes </div>
    @endforelse

</div>