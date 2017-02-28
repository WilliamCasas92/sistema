<div>
    @foreach($etapas as $etapa)
        <div class="panel panel-default">
            @php
                $etapa_activa=\App\Http\Controllers\DatosEtapaController::busqueda_etapa_activa($proceso_contractual->id, $etapa->id);
                if($etapa_activa=='Activo'){
                    $color_panel_activo='panelcollapseactivo';
                    $color_body_activo='bodycollapseactivo';
                }else{
                    $color_panel_activo='';
                    $color_body_activo='';
                }
            @endphp
            <div class="panel-heading" id="{{$color_panel_activo}}">
                <a data-toggle="collapse"  href="#collapse{{ $etapa->id }}">
                <h4 class="panel-title">
                    <label class="text-success">{{ $etapa->nombre }}</label>
                </h4></a>
            </div>
            <div id="collapse{{ $etapa->id }}" class="panel-collapse collapse">
                <div class="panel-body" id="{{$color_body_activo}}">
                    <!-- ACA ES DONDE SALE EL FORMULARIO CON REQUISITOS-->
                    @include('datosetapas.showrequisitos', compact($proceso_contractual, $etapa, $requisitos, $etapa_activa))
                </div>
            </div>
        </div>
    @endforeach
        @include('datosetapas.modalsave')
        <div class="modal" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document" id="datos_faltantes">

            </div>
        </div>
        <script>
        $(document).ready(function() {
            // Interceptamos el evento submit del formulario agregar Etapa, Al fomulario eliminar Etapa
            $('#modalSaveForm').submit(function () {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function (data) {
                        $('#datos_faltantes').html(data);
                        $('#modalSave').modal('hide');
                        $('#modalMensaje').modal('show');
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    alert('No se pudo enviar a la otra etapa');
                });
                return false;
            });



            $(function() {
                $('#modalSave').on("show.bs.modal", function (e) {
                    $("#modalSaveNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalSaveForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
        });
    </script>
</div>