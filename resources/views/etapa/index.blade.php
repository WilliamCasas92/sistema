<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse<?php echo $data->id ?>">{{ $data->nombre }}</a>
        </h4>
        <form action="{{ route('etapa.destroy', $data->id) }}" method="post">
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
        </form>
    </div>
    <div id="collapse<?php echo $data->id ?>" class="panel-collapse collapse">
        <div class="panel-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $data->id ?>">Añadir Dato</button>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo $data->id ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Definición de nuevo dato para: <?php echo $data->nombre ?></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="/requisito/{{$data->id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="InputName" required>Nombre del dato:</label>
                                    <div class="col-md-4">
                                        <input type="text" name="nombre" class="form-control" placeholder="Escriba aquí el nombre del dato" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sel<?php echo $data->id ?>" class="control-label col-md-4" for="InputName"> Seleccione tipo de dato:</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="tiporequisito" id="sel<?php echo $data->id ?>" required>
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

            <h1>Hola requisitos</h1>
            <!-- Fin Modal -->
            <input type="button" value="Añadir Dato Predeterminado" class="btn btn-success"><br>Aca va la lista de datos predeterminados<br>
        </div>
    </div>
</div>