<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Limites por Tier</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">

                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger text-center"> {{$error}} </li>
                        @endforeach
                    </ul>

                    <div class="input-group input-group-static mb-3">
                        <label>Tier a trabajar</label>
                        <select wire:model="tiers_id" class="form-control">
                            <option selected>Seleccione un tier a trabajar</option>
                            @foreach($tiers as $item)
                                <option value="{{ $item->id }}"> {{ $item->nombre }} </option>
                            @endforeach
                        </select>
                        @error('tiers_id')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>

                    @if($this->tiers_id)
                        <table class="table table-sm table-hover">
                            <thead>
                                <th class="text-center">Rango Horario</th>
                                <th>Lunes</th>
                                <th>Martes</th>
                                <th>Miércoles</th>
                                <th>Jueves</th>
                                <th>Viernes</th>
                                <th>Sábado</th>
                                <th>Domingo</th>
                            </thead>
                            <tbody>
                                @foreach($limitList as $key => $limit)
                                    <tr>
                                        <td class="text-center"> {{$key}} </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.lunes" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.martes" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.miercoles" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.jueves" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.viernes" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.sabado" class="form-control form-control-sm"/>
                                        </td>
                                        <td> 
                                            <input type="number" wire:model="limitList.{{$key}}.domingo" class="form-control form-control-sm"/>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                        </div>

                    @endif

                </form>
            </div>
        </div>
    </div>
</div>
