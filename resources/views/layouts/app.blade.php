<x-layouts.base>
    @if (in_array(request()->route()->getName(),['static-sign-in', 'login','password.forgot','reset-password']))
        <main class="main-content  mt-0">
            <div class="page-header page-header-bg align-items-start min-vh-100">
                    <span class="mask bg-gradient-dark opacity-6"></span>
            {{ $slot }}
            <x-footers.guest></x-footers.guest>
                </div>
        </main>
    @else
        {{-- <x-navbars.sidebar></x-navbars.sidebar> --}}
        @livewire('config.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <x-navbars.navs.auth></x-navbars.navs.auth>

            {{ $slot }}

            <x-footers.auth></x-footers.auth>
            <div id="apartadoParaAlertas" class="toast-container position-absolute top-0 end-0 p-3 z-index-2">
                @livewire('config.alertas-show')
            </div>
        </main>
        {{-- <x-plugins></x-plugins> --}}
    @endif
</x-layouts.base>