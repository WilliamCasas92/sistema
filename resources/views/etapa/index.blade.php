<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse<?php echo $etapa->id ?>">{{ $etapa->nombre }}</a>
        </h4>
        <form action="{{ route('etapa.destroy', $etapa->id) }}" method="post">
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
        </form>
    </div>
    <div id="collapse<?php echo $etapa->id ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $etapa->id ?>">Añadir Dato</button>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo $etapa->id ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Definición de nuevo dato para: <?php echo $etapa->nombre ?></h4>
                        </div>
                        <div class="modal-body">
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
            </div>
            <br>
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
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    @endforeach
                </table>
            @endif
            <!-- Fin Modal -->
            <input type="button" value="Añadir Dato Predeterminado" class="btn btn-success"><br>Aca va la lista de datos predeterminados<br>
        </div>
    </div>
</div>