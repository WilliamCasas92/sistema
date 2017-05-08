@extends('master')
@section('editetapa')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><label style="font-size : 25px;">Gestión de Etapas: {{$tipo_proceso->nombre}}</label></div>
            <div class="panel-body">
                <form id="formEtapa" class="form-horizontal" method="post" action="/etapa">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre de la etapa:</label>
                        <div class="col-md-4">
                            <input type="text" id="nombreetapa" name="nombre" class="form-control" autocomplete="off" placeholder="Nombre de la Etapa" onblur="Mayuscula()" required>
                            <script>
                                function Mayuscula() {
                                    var x = document.getElementById("nombreetapa");
                                    x.value = x.value.toUpperCase();
                                }
                            </script>
                        </div>
                    </div>
                    <input type="hidden" name="idtipoproceso" class="form-control" value="{{ $id }}" required><br>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-primary">Agregar Etapa</button>
                        </div>
                    </form>
                </form>
            </div>
            <br>
            <!-- ACA ES DONDE SALEN LAS ETAPAS-->
            <div class="panel-group" id="accordion">
                @include('etapa.index', compact($etapas, $requisitos))
            </div>
            <!--ES DONDE SE LLAMA EL CODIGO DEL MODAL AÑADIR REQUISITO-->
            @include('etapa.modaladdrequisito')
            <!-- se llama el modal eliminar etapa-->
            @include('etapa.modaldeleteetapa')
            <!--Se llama el modal para eliminar requisitos-->
            @include('etapa.modaldeleterequisito')
        </div>
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
@endsection

@section('scriptEtapas')
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script src="/js/jquery-3.1.1.js" language="javascript"></script>-->
    <script language="javascript">
        var listarRequisito = "";
        $(document).ready(function() {
            // Interceptamos el evento submit del formulario agregar Etapa, Al fomulario eliminar Etapa
            $('#formEtapa, #modalDeleteForm').submit(function() {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function(data) {
                        $('#listarEtapas').html(data);
                        $('#modalDelete').modal('hide');
                        $('#formEtapa')[0].reset();
                    }
                }).fail( function( jqXHR, textStatus, errorThrown ) {
                    alert( 'La etapa no se puede eliminar porque tiene requisitos asociados' );
                });
                return false;
            });


            //Esta función toma los datos del botton añadir requisito y los envia al modal para agregar el nuevo dato
            $(function() {
                $('#modalRequisito').on("show.bs.modal", function (e) {
                    $("#modalRequisitoNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalRequisitoForm").attr('action', $(e.relatedTarget).data('url'));
                    listarRequisito=$(e.relatedTarget).data('listar');
                });
            });

            //Esta función envia datos al eliminar requisito

            $(function() {
                $('#modaldeleteRequisito').on("show.bs.modal", function (e) {
                    $("#modaldeleteRequisitoNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modaldeleteRequisitoForm").attr('action', $(e.relatedTarget).data('url'));
                    listarRequisito=$(e.relatedTarget).data('listar');
                });
            });


            //Este responde al formulario guardar tipo de dato que esta en el modaladdrequisito
            $('#modalRequisitoForm, #modaldeleteRequisitoForm').submit(function(event) {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function(data) {
                            $(listarRequisito).html(data);
                            $('#modalRequisito, #modaldeleteRequisito').modal('hide');
                            $('#modalRequisitoForm')[0].reset();
                    }
                });
                event.preventDefault();
                return false;
            });

            $('#FormRequisito').submit(function(event) {
                // Enviamos el formulario usando AJAX
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    // Mostramos un mensaje con la respuesta de PHP
                    success: function(data) {
                        //$(listarRequisito).html(data);
                        alert(data);
                    }
                });
                event.preventDefault();
                return false;
            });
            //Es la función que lleva los datos al modal eliminar etapas
            $(function() {
                $('#modalDelete').on("show.bs.modal", function (e) {
                    $("#modalDeleteNombre").html($(e.relatedTarget).data('nombre'));
                    $("#modalDeleteForm").attr('action', $(e.relatedTarget).data('url'));
                });
            });
        })
    </script>
@endsection