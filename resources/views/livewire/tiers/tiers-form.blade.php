<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Tiers</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">

                    <h4>Datos del Tier:</h4>

                    <div class="input-group input-group-static mt-3">
                        <label>Nombre</label>
                        <input type="text" wire:model="tier.nombre" class="form-control"/>
                    </div>
                    @error('tier.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="form-check form-switch">
                        <input wire:model="tier.activo" class="form-check-input" type="checkbox" >
                        <label class="form-check-label">Activo</label>
                    </div>

                    <br/>

                    <h4>Horarios de control:</h4>
                    <button class="btn bg-gradient-success my-4 mb-2" wire:click.prevent="addHour">
                        <i class="fa-solid fa-plus"></i> Agregar Fila
                    </button>
                    <ul class="list-group">

                        @foreach($arrHours as $index => $hour)
                            <li class="list-group-item">

                                <div class="d-flex flex-col justify-content-around">

                                    <div class="input-group input-group-static me-3">
                                        <label>Tiempo Ponderado</label>
                                        <input type="time" step="1" wire:model="arrHours.{{$index}}.corte" class="form-control"/>
                                    </div>
                                
                                    <div class="input-group input-group-static me-2">
                                        <label>Color de Corte</label>
                                        <select wire:model="arrHours.{{$index}}.color" class="form-control">
                                            <option value=""> Seleccione el color </option>
                                            @foreach(\App\Enums\ColorTMA::cases() as $item)
                                                <option value="{{ $item->value }}"> {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('arrHours.{{$index}}.color')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <button class="btn bg-gradient-success w-10" wire:click.prevent="delHour({{$index}})"> 
                                        Eliminar
                                    </button>

                                </div>

                            </li>
                        @endforeach
                    </ul>

                    <br/>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
