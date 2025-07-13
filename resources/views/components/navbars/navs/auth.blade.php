
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl mb-4">
    <div class="container-fluid py-1 px-3 d-flex flex-row justify-between items-center">
        <div class="">
            <ul class="navbar-nav d-flex flex-row justify-content-between items-center gap-5">
                <li class="nav-item d-flex align-items-center">
                    <button class="text-white btn bg-success me-3 mb-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasMenu" aria-controls="offCanvasMenu">
                        <i class="fa fa-bars me-2" aria-hidden="true"></i> Menu
                    </button>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <div class="font-weight-bold d-none d-lg-inline"> {{env('LOCALIDAD')}} </div>
                </li>
            </ul>
        </div>
        <div class="">
            <form method="POST" action="" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav d-flex flex-row justify-content-between items-center gap-5">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-close me-sm-1"></i>
                        <livewire:auth.logout/>
                    </a>
                </li>

                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a class="nav-link text-white p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasAlertas" aria-controls="offCanvasAlertas">
                        <i class="fa fa-bell"></i>
                        @livewire('config.alertas-badge')
                    </a>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('usuariosMiCuenta')  }}" class="nav-link text-white p-0">
                        <i class="fa fa-user cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
