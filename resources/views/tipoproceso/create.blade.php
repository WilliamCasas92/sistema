@extends('master')
@section('createprocesstype')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Crear Nuevo Tipo de Proceso de Contratación</h3></div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/tipoproceso">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Tipo de Proceso:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Tipo de Proceso - Versión - Año">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputActivo">Determine el estado del Tipo de Proceso:</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked" name="activo" value="1">Activo</label>
                            </div>
                        </div>
                    </div><br>
                    <div >
                        <input id="btnAddEtapa" type="button" value="Añadir Etapa" class="btn btn-success">
                        <input id="btnRemoveEtapa" type="button" value="Eliminar Etapa" class="btn btn-danger">
                    </div><br>

                    <div class="panel-group" id="accordion">
                        <div id="etapas">
                            <!-- En este div se estan creando las estapas del proceso-->
                        </div>
                    </div>

                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Crear Tipo de Proceso de Contratación</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection

@section('Myscripts')
    <script>

        var count=0;
        $(document).ready(function () {
            $('#btnAddEtapa').click(function () {
                count+=1;
                $("#etapas").append("" +
                            "<div id='etapa" + count + "' class='panel panel-default'>" +
                                "<div class='panel-heading'>" +
                                    "<h4 class='panel-title'>" +
                                        "<a data-toggle='collapse' data-parent='#accordion' href='#collapse" + count + "'>Etapa " + count + "</a>" +
                                    "</h4>" +
                                "</div>" +
                                "<div id='collapse" + count + "' class='panel-collapse collapse'>" +
                                    "<div class='panel-body'>" +
                                        "<div class='form-group'>" +
                                            "<label class='control-label col-md-4' for='InputNameEtapa'>Nombre de la Etapa:</label>" +
                                            "<div class='col-md-4'>" +
                                            "<input type='text' name='nombreEtapa" + count + "' class='form-control' placeholder='Nombre de la Etapa'>" +
                                            "</div>" +
                                        "</div>" +
                                        "<div class='form-group'>" +
                                            "<label class='control-label col-md-4' for='InputDocuemtnos'>Permitir añadir documentos:</label>" +
                                            "<div class='col-md-4'>" +
                                                "<div class='checkbox'>" +
                                                    "<label><input type='checkbox' checked='checked' name='addDocumentos" + count + "' value='1'>Activo</label>" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>" +
                                        "<div><input id='btnAddDato" + count + "' type='button' value='Añadir Dato' class='btn btn-success'><br><div id='datos" + count + "'> </div><br></div>" +
                                        "<div><input id='btnAddDatoPredeterminado" + count + "' type='button' value='Añadir Dato Predeterminado' class='btn btn-success'><br><br></div>" +
                                        "<div><input id='btnAddCheckBox" + count + "' type='button' value='Añadir Dato CheckBox' class='btn btn-success'><br><br></div>" +
                                    "</div>" +
                                "</div>" +
                            "</div>");
            });
        });

        $(document).ready(function(){
            $("#btnRemoveEtapa").click(function(){
                $("#etapa" + count + "").remove();
                if (count > 0){
                    count-=1;
                } else{
                    alert("No existen Etapas para eliminar.");
                }
            });
        });

        $(document).ready(function(){
            $("#btnAddDato1").click(function(){
                $("#datos1").append(" <b>Appended text</b>.");
            });
        });


    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
