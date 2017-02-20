<div class="modal" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="modalSaveTitulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="datos_faltantes">
            <div class="modal-header"id="datos_faltantes">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteTitulo">Confirmar paso a la siguiente Etapa.</h4>
            </div>
            <div class="modal-body">
                <p>
                    Seguro que desea enviar <b><span id="modalSaveNombre"></span></b>
                </p>
            </div>
            <div class="modal-footer" id="datos_faltantes">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <span class="pull-right">
                    <form class="form-horizontal" id="modalSaveForm" method="post" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <form class="form-inline">
                            <div align="center">
                                <button type="submit" class="btn btn-primary">Enviar a siguiente etapa</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </form>
                </span>
            </div>
        </div>
    </div>
</div>
