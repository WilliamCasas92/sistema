<h1>{{ $row->id }}</h1>

<div class="modal fade" id="myModalRol<?php echo $etapa->id ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asigne los Roles para: <?php echo $etapa->nombre ?></h4>
            </div>
            <div class="modal-body">
                <!-- Formulario Añadir ROLES-->
                <form class="form-horizontal" method="post" action="/etapa/{{ $etapa->id }}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="text" name="nombre" class="form-control" value="{{ $etapa->nombre }}" required>
                    <input type="text" name="tipoprocesoid" class="form-control" value="{{ $etapa->tipo_procesos_id }}" required>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputRoles">Roles</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Administrador') ? 'checked':''}} name="rol_admin" value="1">Administrador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Coordinador') ? 'checked':''}} name="rol_coordinador" value="2">Coordinador</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Secretario') ? 'checked':''}} name="rol_secretario" value="3">Secretario</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Abogado') ? 'checked':''}} name="rol_abogado" value="4">Abogado</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Gestor de contratación') ? 'checked':''}} name="rol_gestorcontratacion" value="5">Gestor de Contratación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Gestor de notificación') ? 'checked':''}} name="rol_gestornotificacion" value="6">Gestor de Notificación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Gestor de afiliación') ? 'checked':''}} name="rol_gestorafiliacion" value="7">Gestor de Afiliación</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Gestor de archivo') ? 'checked':''}} name="rol_gestorarchivo" value="8">Gestor de Archivo</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $etapa->hasRol('Gestor de publicación') ? 'checked':''}} name="rol_gestorpublicacion" value="9">Gestor de Publicación</label>
                            </div>
                        </div>
                    </div><br>

                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Asignar Roles</button>
                        </div>
                    </form>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><br>




<div class="modal fade" id="myModal<?php echo $etapa->id ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Definición de nuevo dato para: <?php echo $etapa->nombre ?></h4>
            </div>
            <div class="modal-body">
                <!-- Formulario Añadir Requisitos-->
                <form class="form-horizontal" method="post" action="/requisito/{{ $etapa->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName" required>Nombre del dato:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Escriba aquí el nombre del dato" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sel<?php echo $etapa->id ?>" class="control-label col-md-4" for="InputName"> Seleccione tipo de dato:</label>
                        <div class="col-md-4">
                            <select class="form-control" name="tiporequisito" id="sel<?php echo $etapa->id ?>" required>
                                <option value="1">Texto</option>
                                <option value="2">Documento</option>
                                <option value="3">Email</option>
                                <option value="4">Fecha</option>
                                <option value="5">Hora</option>
                                <option value="6">Casilla de Verificación</option>
                                <option value="7">Número</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputActivo">Dato obligatorio:</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked" name="obligatorio" value="1"></label>
                            </div>
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Crear Dato</button>
                        </div>
                    </form>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><br>


@if($data1)
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">Nombre dato</th>
            <th class="text-center">Tipo de dato</th>
            <th class="text-center">Obligatorio</th>
            <th class="text-center">Fecha de creación</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data1 as $row1)
            @if($row1->etapas_id==$etapa->id )
                <tr>
                    <td class="text-center">{{ $row1->nombre }}</td>
                    <td class="text-center">{{ $row1->tipo_requisitos_id }}</td>
                    <td class="text-center">{{ $row1->obligatorio }}</td>
                    <td class="text-center">{{ $row1->created_at }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModaledit<?php echo $etapa->id ?>">Editar</button>
                        <!-- Modal Editar Requisito-->
                        <div class="modal fade" id="myModaledit<?php echo $etapa->id ?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Actualizacion de dato</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" method="post" action="/requisito/{{ $row1->id }}">
                                            <input name="_method" type="hidden" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="InputName" required>Nombre del dato:</label>
                                                <div class="col-md-4">
                                                    <input type="text" name="nombre" class="form-control" placeholder="Escriba aquí el nombre del dato" value="{{ $row1->nombre }}" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="seledit<?php echo $etapa->id ?>" class="control-label col-md-4" for="InputName"> Seleccione tipo de dato:</label>
                                                <div class="col-md-4">
                                                    <select class="form-control" name="tiporequisito" id="seledit<?php echo $etapa->id ?>" required>
                                                        <option value="1">Texto</option>
                                                        <option value="2">Documento</option>
                                                        <option value="3">Email</option>
                                                        <option value="4">Fecha</option>
                                                        <option value="5">Hora</option>
                                                        <option value="6">Casilla de Verificación</option>
                                                        <option value="7">Número</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4" for="InputActivo">Dato obligatorio:</label>
                                                <div class="col-md-4">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" {{ $row1->obligatorio ? 'checked':''}} name="activo" value="1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <form class="form-inline">
                                                <div align="center">
                                                    <button type="submit" class="btn btn-default">Actualizar Dato</button>
                                                </div>
                                            </form>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('requisito.destroy', $row1->id) }}" method="post">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endif
        </tbody>
        @endforeach
    </table>
@endif



@foreach($data as $etapa)
    @include('etapa.index', compact($etapa, $data1))
@endforeach



<div class="modal fade" id="myModaledit<?php echo $etapa->id ?>" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Actualizacion de dato</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="/requisito/{{ $row1->id }}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName" required>Nombre del dato:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Escriba aquí el nombre del dato" value="{{ $row1->nombre }}" required>
                        </div>
                    </div>
                    <input type="text" class="form-control"  value="{{ $row1->id }}">

                    <div class="form-group">
                        <label for="seledit<?php echo $etapa->id ?>" class="control-label col-md-4" for="InputName"> Seleccione tipo de dato:</label>
                        <div class="col-md-4">
                            <select class="form-control" name="tiporequisito" id="seledit<?php echo $etapa->id ?>" required>
                                <option value="1">Texto</option>
                                <option value="2">Documento</option>
                                <option value="3">Email</option>
                                <option value="4">Fecha</option>
                                <option value="5">Hora</option>
                                <option value="6">Casilla de Verificación</option>
                                <option value="7">Número</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputActivo">Dato obligatorio:</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $row1->obligatorio ? 'checked':''}} name="activo" value="1"></label>
                            </div>
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Actualizar Dato</button>
                        </div>
                    </form>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>