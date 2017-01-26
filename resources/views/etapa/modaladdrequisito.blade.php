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