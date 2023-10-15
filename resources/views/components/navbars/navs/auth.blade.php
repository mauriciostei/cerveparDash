
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="d-flex flex-row">
            <button id="toggleMenu" class="flex text-white btn bg-primary p-2 me-3">
                Menú
            </button>
            <div class="font-weight-bold overflow-hidden"> {{env('LOCALIDAD')}} </div>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <form method="POST" action="" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                        <i class="fa fa-close me-sm-1"></i>
                        <livewire:auth.logout/>
                    </a>
                </li>
                
                <li class="nav-item px-3 d-flex align-items-center">
                </li>

                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a class="nav-link text-white p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasAlertas" aria-controls="offCanvasAlertas">
                        <i class="fa fa-bell"></i>
                        @livewire('config.alertas-badge')
                    </a>
                </li>

                <li class="nav-item px-3 d-flex align-items-center">
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
