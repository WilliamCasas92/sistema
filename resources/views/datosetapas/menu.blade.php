@extends('master')
@section('checkprocess')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <a data-toggle="collapse"  data-parent="#accordion" href="#collapseprocesocontractual">
                    <h3><label class="text-success">Datos generales del contrato</label></h3>
                </a>
            </div>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div id="collapseprocesocontractual" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed table-headborderless">
                                    <h5 class="text-primary" ><label>Información general del contrato</label></h5>
                                    <thead style="font-size : 11px;">
                                    <tr>
                                        <th class="text-center text-primary" width="35%"></th>
                                        <th class="text-center" width="50%"></th>
                                    </tr>
                                    </thead>
                                    <tbody style="font-size : 11px;">
                                    <tr>
                                        <td class="text-center" width="35%"><label>Tipo de proceso de contratacion:</label></td>
                                        <td width="35%">{{ $proceso_contractual->tipo_proceso }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%"><label>Número de CDP:</label></td>
                                        <td width="35%">{{ $proceso_contractual->numero_cdp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%" ><label>Objeto del contrato:</label></td>
                                        <td class="text-justify" width="35%">{{ $proceso_contractual->objeto }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%"><label>Valor del contrato:</label></td>
                                        <td width="35%">${{number_format($proceso_contractual->valor)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%"><label>Periodo de ejecución:</label></td>
                                        <td width="35%">{{ $proceso_contractual->plazo }} día(s)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%"><label>Dependencia correspondiente:</label></td>
                                        <td width="35%">{{ $proceso_contractual->dependencia }}</td>
                                    </tr>
                                    @if(($proceso_contractual->numero_contrato=='0')||($proceso_contractual->numero_contrato==''))
                                        <tr>
                                            <td class="text-center" width="35%"><label>Número de contrato:</label></td>
                                            <td width="35%">Sin asignar.</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" width="35%"><label>Número de contrato:</label></td>
                                            <td width="35%">{{ $proceso_contractual->numero_contrato }}</td>
                                        </tr>
                                    @endif
                                    @if ($proceso_contractual->nombre_supervisor!='')
                                        <tr>
                                            <td class="text-center" width="35%"><label>Nombre del supervisor:</label></td>
                                            <td width="35%">{{ $proceso_contractual->nombre_supervisor }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" width="35%"><label>Nombre del supervisor:</label></td>
                                            <td width="35%">Sin asignar.</td>
                                        </tr>
                                    @endif
                                    @if ($proceso_contractual->id_supervisor!='')
                                        <tr>
                                            <td class="text-center" width="35%"><label>Identificación del supervisor:</label></td>
                                            <td width="35%">{{ $proceso_contractual->id_supervisor }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" width="35%"><label>Identificación del supervisor:</label></td>
                                            <td width="35%">Sin asignar.</td>
                                        </tr>
                                    @endif
                                    @if ($proceso_contractual->email_supervisor!='')
                                        <tr>
                                            <td class="text-center" width="35%"><label>Email del supervisor:</label></td>
                                            <td width="35%">{{ $proceso_contractual->email_supervisor }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" width="35%"><label>Email del supervisor:</label></td>
                                            <td width="35%">Sin asignar.</td>
                                        </tr>
                                    @endif
                                    @if(Auth::user()->hasRol('Administrador'))
                                        <tr>
                                            <td class="text-center" width="35%"><label>Fecha y Hora de ingreso en el sistema:</label></td>
                                            <td width="35%">{{ $proceso_contractual->created_at }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-center" width="35%"><label>Comites participantes:</label></td>
                                        <td width="35%">
                                            @if ( ($proceso_contractual->comiteinterno)=='1' )
                                                Comité Interno de Docencia e Investigación <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}</br>
                                            @elseif( ($proceso_contractual->comiteinterno)=='2' )
                                                Comité Interno de Extensión <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}<br>
                                            @elseif( ($proceso_contractual->comiteinterno)=='3' )
                                                Comité Interno de Administración <label>Fecha:</label> {{$proceso_contractual->fecha_comiteinterno}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiterectoria)=='4' )
                                                Comité Interno de Rectoría <label>Fecha:</label> {{$proceso_contractual->fecha_comiterectoria}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiteasesor)=='5' )
                                                Comité Asesor de Contratación <label>Fecha:</label> {{$proceso_contractual->fecha_comiteasesor}}<br>
                                            @endif
                                            @if (($proceso_contractual->comiteevaluador)=='6' )
                                                Comité Evaluador <label>Fecha:</label> {{$proceso_contractual->fecha_comiteevaluador}}<br>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" width="35%"><label>Estado del proceso:</label></td>
                                        <td width="35%">{{ $proceso_contractual->estado }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Observaciones que contiene el contracto-->
            <div class="margincollapse">
                <div class="panel-group panel-default" >
                    <div class="panel-heading">
                        <a data-toggle="collapse"  href="#collapseprocesoobservaciones">
                            <h4 class="panel-title">
                                <label class="text-success">Observaciones del contracto</label>
                            </h4>
                        </a>
                    </div>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div id="collapseprocesoobservaciones" class="panel-collapse collapse">

                                    @include('datosetapas.showobservaciones', compact($observaciones, $proceso_contractual))

                            </div>
                        </div>
                    </div>
                </div>
            </div>

           <!-- ACA ES DONDE SALEN LAS ETAPAS-->
            <div class="margincollapse">
                <div class="panel-group" id="accordion">
                    @include('datosetapas.showetapas', compact($proceso_contractual, $etapas, $requisitos))
                </div>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('consulta.mostrar')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
    @include('datosetapas.modalsave')
    <div class="modal" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="modalMensaje" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document" id="datos_faltantes"></div>
    </div>
    @include('datosetapas.modaladddocumento')
    @include('datosetapas.modaldeletedocumento')
    @include('datosetapas.modalfinalizar')
@endsection
@section('scriptDatosEtapas')
    <script src="/js/dropzone.js" type="text/javascript"></script>
    <link href="{{asset('/css/dropzone.css')}}" rel="stylesheet">
    <script>
        var mostrar = "";
        var boton = "";
        $(document).ready(function()
        {

            /** Ecript de configuración de dropzone**/
             Dropzone.options.myDropzone = {

                 init: function () {
                     var submitBtn = document.querySelector("#submit");
                     myDropzone = this;

                    this.on("complete", function (file) {
                         setTimeout(function() {
                             $('#modaladdDocumento').modal('hide');
                             myDropzone.removeFile(file);
                         },1000);
                    });
                     this.on("success", function(file, responseText) {
                         $(mostrar).html(responseText);
                         $('#Nombre').html(responseText);
                         $(boton).attr("disabled", false);
                     });

                 }
            };

            //En este se envian los datos al modal de subir documento
            $(function() {
                $('#modaladdDocumento').on("show.bs.modal", function (e) {
                    $("#modaladdDocumentoIdrequisito").val($(e.relatedTarget).data('idrequisito'));
                    $("#modaladdDocumentoIdproceso").val($(e.relatedTarget).data('idprocesocontractual'));
                    $("#modaladdDocumentoIdetapa").val($(e.relatedTarget).data('idetapa'));
                    mostrar = $(e.relatedTarget).data('mostrar');
                    boton = $(e.relatedTarget).data('boton');
                });
            });
            //Toma los datos que se enviaran al modal eliminar documento
            $(function() {
                $('#modaldeleteDocumento').on("show.bs.modal", function (e) {
                    $("#modaldeleteDocumentoIdrequisito").val($(e.relatedTarget).data('idrequisito'));
                    $("#modaldeleteDocumentoIdproceso").val($(e.relatedTarget).data('idprocesocontractual'));
                    $("#modaldeleteDocumentoForm").attr('action', $(e.relatedTarget).data('url'));
                    $("#modaldeleteDocumentoNombre").html($(e.relatedTarget).data('nombre'));
                    mostrar = $(e.relatedTarget).data('mostrar');
                    boton = $(e.relatedTarget).data('boton');
                });
            });

            // Interceptamos el evento submit del formulario subir documento y eliminar documento
            $('#modaldeleteDocumentoForm').submit(function () {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function (data) {
                        $(mostrar).html(data);
                        $('#Nombre').html(data);
                        $('#modaldeleteDocumento').modal('hide');
                        $(boton).attr("disabled", true);
                    }
                });
                return false;
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            // Interceptamos el evento submit del formulario pasar Etapa, Al fomulario eliminar Etapa
            $('#modalSaveForm').submit(function () {
                $('#cargando').html('<div><img class="center-block" src="/images/loading.gif" width="100" height="100"/></div>');
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function (data) {
                        $('#modalSave').modal('hide');
                        $('#modalMensaje').modal('show');
                        $('#datos_faltantes').fadeIn(1000).html(data);
                    }
                });
                return false;
            });
            $(function() {
                $('#modalSave').on("show.bs.modal", function (e) {
                    $("#modalSaveNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalSaveForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
            //Finalizando el proceso
            $('#modalFinalForm').submit(function () {
                $('#cargandoFinalizar').html('<div><img class="center-block" src="/images/loading.gif" width="100" height="100"/></div>');
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function (data) {
                        $('#modalFinal').modal('hide');
                        $('#modalMensaje').modal('show');
                        $('#datos_faltantes').fadeIn(1000).html(data);

                    }
                });
                return false;
            });
            $(function() {
                $('#modalFinal').on("show.bs.modal", function (e) {
                    $("#modalFinalNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalFinalForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
            //Toma los datos del formulario agregar y  eliminar observación y los envia por ajax
            $('#modaladdObservacionForm, #modaldeleteObservacionForm, #modaleditObservacionForm').submit(function () {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function (data) {
                        $('#modaladdObservacion, #modaldeleteObservacion, #modaleditObservacion').modal('hide');
                        $('#modaladdObservacionForm')[0].reset();
                    }
                });
                return false;
            });

            //Envia los datos al formulario crear observación
            $(function() {
                $('#modaladdObservacion').on("show.bs.modal", function (e) {
                    $("#modaladdObservacionIdproceso").val($(e.relatedTarget).data('idproceso'));
                });
            });
            //Envia los datos al formulario Editar observación
            $(function() {
                $('#modaleditObservacion').on("show.bs.modal", function (e) {
                    $("#modaleditObservacionIdproceso").val($(e.relatedTarget).data('idproceso'));
                    $("#modaleditObservacionTexto").val($(e.relatedTarget).data('observacion'));
                    $("#modaleditObservacionForm").attr('action', $(e.relatedTarget).data('url'));

                });
            });
            //Envia los datos al  formulario eliminar observación
            $(function() {
                $('#modaldeleteObservacion').on("show.bs.modal", function (e) {
                    $("#modaldeleteObservacionTexto").val($(e.relatedTarget).data('observacion'));
                    $("#modaldeleteObservacionForm").attr('action', $(e.relatedTarget).data('url'));

                });
            });
        });
    </script>
@endsection