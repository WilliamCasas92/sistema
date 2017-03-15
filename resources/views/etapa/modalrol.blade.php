<div class="modalrol modal fade" id="myModalRol<?php echo $etapa->id ?>"  role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asigne los Roles para: <?php echo $etapa->nombre ?></h4>
            </div>
            <div class="modal-body">
                <!-- Formulario Añadir ROLES-->
                <form id="formRol{{$etapa->id}}" class="form-horizontal" method="POST" action="/etapa/{{ $etapa->id }}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-5" for="InputRoles">Roles</label>
                        <div class="col-md-5">
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
                    <div class="modal-footer">
                        <form class="form-inline">
                            <div align="center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Asignar Roles</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
