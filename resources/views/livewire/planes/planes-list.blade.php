<div class="">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-lg-10">
                                    <h6 class="text-white text-capitalize ps-3 pt-2">Lista de Planes</h6>
                                </div>
                                <div class="col-lg-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        
                        <form wire:submit.prevent="download" class="row mb-4 px-5">
                            <span class="col-1"></span>
                            <div class="col-8">
                                <div class="input-group input-group-static">
                                    <label>Planificación a Descargar</label>
                                    <select class="form-control" name="planificaciones_file" wire:model="file">
                                        @forelse($files as $file)
                                        <option value="{{$file}}"> {{$file}} </option>
                                        @empty
                                        <option selected disabled>Sin Planificaciones importadas aun!</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <span class="col-1"></span>
                            <input type="submit" value="Descargar" class="btn btn-primary btn-sm shadow col-1">
                            <span class="col-1"></span>
                        </form>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Planes</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Móviles</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Choferes</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Accuracy</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Usuario Generador</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Ultima Actualización</th>
                                        <th class="text-secondary opacity-7" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse( $planes as $plan )
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$plan->fecha}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$plan->moviles->unique()->count()}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$plan->choferes->unique()->count()}} </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> 
                                                {{-- {{round($plan->acuraccy(),0)}} %  --}}
                                                {{ $plan->Accuracy }}%
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> @if($plan->users_id) {{$plan->users->name}} @endif </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"> {{$plan->ultima_actualizacion}} </p>
                                        </td>
                                        <td class="align-middle">
                                            @if($plan->fecha >= date('Y-m-d'))
                                                @can('update', $plan)
                                                <a href="{{ route('planesForm', ['id' => $plan->id]) }}"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Editar Plan">
                                                    Editar
                                                </a>
                                                @endcan
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('planesHistory', ['id' => $plan->id]) }}" class="text-secondary font-weight-bold text-xs">
                                                Historial de Cambios
                                            </a>
                                        </td>
                                    </tr>

                                    @empty
                                        <tr>
                                            <td colspan="3" class="align-middle text-center">Sin datos</td>
                                        </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
