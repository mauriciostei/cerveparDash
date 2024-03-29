
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 max-height-vh-100"
    id="sidenav-main"
    >
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('inicio') }} ">
                <img src="{{ asset('assets') }}/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
            </a>
    </div>
    <div class="w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav me-2 ms-2">

            @forelse($subMenu as $s)
                <li class="nav-item mt-1">
                    <h6 class="ps-3 ms-2 text-uppercase text-xs font-weight-bolder opacity-8"> {{$s->categoria}} </h6>
                </li>
                @forelse($menu as $m)
                    @if($m->categoria === $s->categoria)
                        @if($m->leer)
                        
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == $m->link ? ' active bg-gradient-success' : '' }} "
                                href="{{ route($m->link) }}">
                                <div class="text-center me-1 d-flex align-items-center justify-content-center">
                                    <i class="fa {{$m->icono}} text-white opacity-10"></i>
                                </div>
                                <span class="nav-link-text text-white ms-1"> {{$m->nombre}} </span>
                            </a>
                        </li>
                        @endif

                    @endif
                @empty
                @endforelse
            @empty
                Usuario no tiene permisos
            @endforelse
        </ul>
    </div>
</aside>
