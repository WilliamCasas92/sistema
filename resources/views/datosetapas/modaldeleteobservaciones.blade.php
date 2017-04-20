<div class="modal fade" id="modaldeleteObservacion" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" >Eliminar Observación</h4>
            </div>
            <div class="modal-body">
                <label>Seguro que desea eliminar la obserservación:</label></br>
                <modal   id="modaldeleteObservacionTexto"></modal>
                <form   id="modaldeleteObservacionForm" method="POST">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}
                    <div align="center">
                        </br>
                        <button type="button" class="btn " data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-danger" value="Eliminar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>