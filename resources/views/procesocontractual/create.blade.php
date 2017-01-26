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
                        <div class="col-md-4">
                            <input type="text" name="tipoproceso" class="form-control" autocomplete="off" placeholder="Seleccione el Tipo de Proceso" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Número de CDP: </label>
                        <div class="col-md-4">
                            <input type="number" name="numcdp" class="form-control" autocomplete="off" placeholder="Número de CDP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Objeto: </label>
                        <div class="col-md-4">
                            <input type="text" name="objeto" class="form-control" autocomplete="off" placeholder="Objeto del contrato" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Depedencia: </label>
                        <div class="col-md-4">
                            <input type="text" name="dependencia" class="form-control" autocomplete="off" placeholder="Seleccione Dependencia" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Número de Contrato: </label>
                        <div class="col-md-4">
                            <input type="number" name="numcontrato" class="form-control" autocomplete="off" placeholder="Número de Contrato">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Fecha de Aprobación: </label>
                        <div class="col-md-4">
                            <input type="date" name="dateaprobación" class="form-control" autocomplete="off" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Supervisor: </label>
                        <div class="col-md-4">
                            <input type="text" name="nombresupervisor" class="form-control" autocomplete="off" placeholder="Nombre del Supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Email del Supervisor: </label>
                        <div class="col-md-4">
                            <input type="email" name="emailsupervisor" class="form-control" autocomplete="off" placeholder="Email del Supervisor">
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Crear Proceso de Contratación</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection