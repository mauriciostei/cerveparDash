<div class="">
    <div class="container-fluid py-4">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Formulario de Perfiles</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form wire:submit.prevent="save">
                    <div class="input-group input-group-static mt-3">
                        <label >Nombre</label>
                        <input type="text" wire:model="perfil.nombre" class="form-control"/>
                    </div>
                    @error('perfil.nombre')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror

                    <br/>

                    <div class="form-check form-switch">
                        <input wire:model="perfil.activo" class="form-check-input" type="checkbox" >
                        <label class="form-check-label">Activo</label>
                    </div>

                    <br/>

                    <h6>Permisos del Perfil</h6>

                    <table class="table align-items-center mb-0 mt-3 table-hover">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Permiso</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Leer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Crear</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $permisos as $per )
                                <tr>
                                    <td class="align-middle text-sm"> {{$per->nombre}} </td>
                                    <td class="">
                                        <div class="form-check form-switch">
                                            <input wire:model="selectedLeer.{{ $per->id }}" class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="form-check form-switch">
                                            <input wire:model="selectedCrear.{{ $per->id }}" class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="form-check form-switch">
                                            <input wire:model="selectedEditar.{{ $per->id }}" class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Sin permisos</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <br/>

                    

                    <div class="d-flex flex-column flex-lg-row justify-content-around mt-2">

                        <div>
                            <h6>Módulos de Aprobación</h6>
                            <ul class="list-group">
                                @forelse($aprobables as $ap)
                                    <li class="list-group-item">
                                        <div class="form-check form-switch">
                                            <input wire:model="selectedAprobables.{{ $ap->id }}"  class="form-check-input" type="checkbox">
                                            <label class="form-check-label">{{$ap->nombre}}</label>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">Sin módulos para aprobar</li>
                                @endforelse
                            </ul>
                        </div>

                        <div>
                            <h6>Alertas a trabajar</h6>
                            <ul class="list-group">
                                @forelse($tiposAlertas as $ap)
                                    <li class="list-group-item">
                                        <div class="form-check form-switch">
                                            <input wire:model="selectedTiposAlertas.{{ $ap->id }}"  class="form-check-input" type="checkbox">
                                            <label class="form-check-label">{{$ap->nombre}}</label>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">Sin alertas para trabajar</li>
                                @endforelse
                            </ul>
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
