<div class="modal" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="modalSaveTitulo" data-backdrop="static" data-keyboard="false">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Confirmar paso a la siguiente Etapa.</h4>
            </div>
            <div class="modal-body">
                <p align="center">
                    ¿Seguro que ha finalizado con la etapa <b><span id="modalSaveNombre"></span></b> ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <span class="pull-right">
                    <form class="form-horizontal" id="modalSaveForm" method="GET" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <form class="form-inline">
                            <div align="center">
                                <button type="submit" class="btn btn-success">Enviar a siguiente etapa</button>
                            </div>
                        </form>
                    </form>
                </span>
            </div>
        </div>
    </div>
</div>