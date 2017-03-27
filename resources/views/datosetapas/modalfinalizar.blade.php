<div class="modal" id="modalFinal" tabindex="-1" role="dialog" aria-labelledby="modalSaveTitulo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteTitulo">Confirmar finalizacion.</h4>
            </div>
            <div class="modal-body">
                <p>
                    ¿Seguro que ha finalizado con exito el proceso?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <span class="pull-right">
                    <form class="form-horizontal" id="modalFinalForm" method="GET" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <form class="form-inline">
                            <div align="center">
                                <button type="submit" class="btn btn-danger ">Finalizar</button>
                            </div>
                        </form>
                    </form>
                </span>
            </div>
        </div>
    </div>
</div>