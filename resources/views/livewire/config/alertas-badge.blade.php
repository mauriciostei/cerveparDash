<div wire:poll.keep-alive>
    @if($alertas > 0)
        <span class="position-absolute top-50 pb-2 start-100 translate-middle badge rounded-pill bg-danger">
            {{$alertas}}
        </span>
    @endif
</div>