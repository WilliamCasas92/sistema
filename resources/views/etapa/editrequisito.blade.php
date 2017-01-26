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