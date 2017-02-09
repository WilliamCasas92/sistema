<div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteTitulo">Confirmar eliminación</h4>
            </div>
            <div class="modal-body">
                <p>
                    Confirma que desea eliminar <b><span id="modalDeleteNombre"></span></b>?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <span class="pull-right">
                    <form id="modalDeleteForm"  method="post">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                        <button id="eliminar" type="submit" class="btn btn-danger btn-xs" >Eliminar</button>
                    </form>
                </span>
            </div>
        </div>
    </div>
</div>
