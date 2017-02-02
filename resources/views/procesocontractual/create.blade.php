@extends('master')
@section('createcontractualprocess')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Crear Nuevo Proceso de Contratación</h3></div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/procesocontractual">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Tipo de Proceso: </label>
                        <div class="col-md-5">
                            <input type="text" name="tipo_proceso" class="form-control" autocomplete="off" placeholder="Seleccione el tipo de proceso de contratación" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Número de CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_cdp" class="form-control" autocomplete="off" placeholder="Digite el número de CDP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Objeto: </label>
                        <div class="col-md-5">
                            <textarea rows="5" name="objeto" class="form-control" autocomplete="off" placeholder="Digite el objeto del contrato" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Depedencia: </label>
                        <div class="col-md-5">
                            <input type="text" name="dependencia" class="form-control" autocomplete="off" placeholder="Seleccione la dependencia correspondiente" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Número de Contrato: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_contrato" class="form-control" autocomplete="off" placeholder="Digite el número de contrato">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Fecha de Aprobación: </label>
                        <div class="col-md-3">
                            <input type="date" name="date_aprobación" class="form-control" autocomplete="off" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Digite el nombre del supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Email del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="email" name="email_supervisor" class="form-control" autocomplete="off" placeholder="Digite el email del supervisor">
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <br><button type="submit" class="btn btn-default">Crear Proceso de Contratación</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection