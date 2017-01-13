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
                    @if(session()->has('msj'))
                        <div class="alert alert-danger" role="alert">{{ session('msj') }}</div>
                    @endif
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputActivo">Determine el estado del Tipo de Proceso:</label><br>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked" name="activo" value="1">Activo</label>
                            </div>
                        </div>
                    </div><br>
                    <div >
                        <input id="btn1" type="button" value="Añadir Etapa" class="btn btn-success">
                    </div><br>
                    <div id="etapa">
                        <!-- En este div se estan creando las estapas del proceso-->
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

        function añadirEtapa() {
            var lblNombre= $("<label></label>").text("Nombre Etapa");
            var inputNombre=$("<input></input>");
            $("body").append(lblNombre, inputNombre);
        }
        var count=0;
        $(document).ready(function () {
            $('#btn1').click(function () {
                count+=1;
                $("#etapa").append("" +
                    "<div class='form-group'>" +
                        "<div class='panel-group' id='accordion'>" +
                            "<div class='panel panel-default'>" +
                                "<div class='panel-heading'>" +
                                    "<h4 class='panel-title'>" +
                                        "<a data-toggle='collapse' data-parent='#accordion' href='#collapse" + count + "'>Etapa " + count + "</a>" +
                                "</h4></div>" +
                                "<div id='collapse" + count + "' class='panel-collapse collapse in'>" +
                                    "<div class='panel-body'>" +
                                        "<label class='control-label col-md-4' for='InputNameEtapa'>Nombre de la Etapa:</label>" +
                                        "<div class='col-md-4'>" +
                                        "<input type='text' name='nombreEtapa" + count + "' class='form-control' placeholder='Nombre de la Etapa'>" +
                    "</div></div></div></div></div></div>");
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
