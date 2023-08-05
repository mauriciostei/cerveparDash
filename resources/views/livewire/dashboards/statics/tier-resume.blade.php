<div class="card mt-4 mt-lg-0" wire:poll.1000ms>
    <div class="card-header p-3 pt-2">
        <div
            class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <img class="pt-2 pr-1" src="{{ asset('assets').$image }}" alt="camion de t1" width="45px"/>
        </div>
        <div class="text-end pt-1">
            <p class="text-lg mb-0 text-capitalize">Móviles <span class="font-weight-bolder"> {{$tier}} </span> </p>
            <h4 class="mb-0 text-lg"> {{ $total }} </h4>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="text-lg">
            On Time: <span class="text-success text-lg font-weight-bolder"> {{ $ontime }} </span>
        </div>
        <div class="text-lg">
            Out of Time: <span class="text-danger text-lg font-weight-bolder"> {{$outoftime }} </span>
        </div>
    </div>

    <div class="card-footer p-3 pt-0">
        <p class="mb-0 text-lg"><span class="text-success text-lg font-weight-bolder"> {{ $percentage }}% </span>de cumplimiento</p>
    </div>
</div>