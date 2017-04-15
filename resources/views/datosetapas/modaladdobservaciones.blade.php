<div class="modal fade" id="modaladdObservacion" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalDeleteTitulo">Agregar Observación</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('observacion') }}" method="POST">
                    {{ csrf_field() }}
                    <label for="comment">   Obserservación:</label>
                    <input type="hidden" id="modaladdObservacionIdproceso" name="proceso_contractual_id" />
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                    <textarea rows="5" name="observacion" class="form-control" required></textarea><br/>
                    <div align="center">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-success" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>