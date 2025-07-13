<div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu">
    <div class="offcanvas-header bg-dark">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('inicio') }} ">
                <img src="{{ asset('assets') }}/img/logo.png" width="200" alt="main_logo">
            </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-dark">
        @forelse($subMenu as $s)
            <h6 class="mt-3"> {{$s->categoria}} </h6>
            @forelse($menu as $m)
                <ul class="list-group">
                @if($m->categoria === $s->categoria && $m->leer)
                        <li class="list-group-item list-group-item-action py-1">
                            <a class="nav-link {{ Route::currentRouteName() == $m->link ? ' active bg-gradient-warning font-weight-bold' : '' }} "
                                href="{{ route($m->link) }}">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="text-white"> {{$m->nombre}} </span>
                                    <span class="badge bg-gradient-success rounded-pill shadow-lg">
                                        <i class="fa {{$m->icono}} text-withe opacity-10"></i>
                                    </span>
                                </div>
                            </a>
                        </li>
                @endif
                </ul>
            @empty
                <p>Sin permisos en categoria</p>
            @endforelse
        @empty
            <p>Usuario no cuenta con permisos</p>
        @endforelse
    </div>
</div>