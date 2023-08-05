<div>
    @if ($message = Session::get('message'))

        <div class="position-fixed top-3 end-1 z-index-2">
            <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="fa-solid fa-check text-success me-2"></i>
                    <span class="me-auto font-weight-bold">Mensaje del Sistema</span>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    {{$message}}
                </div>
            </div>
        </div>

    @endif
</div>