@extends('master')
@section('createcontractualprocess')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Crear nuevo proceso de contratación</h3></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/procesocontractual">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Seleccione el Tipo de Proceso de Contratación: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="tipo_proceso" id="tipo_proceso" required>
                                @foreach($tipos_procesos as $tipo_proceso)
                                    <option value="{{$tipo_proceso->nombre}}">{{$tipo_proceso->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputNumCDP">Número de CDP: </label>
                        <div class="col-md-3">
                            <input type="text" name="num_cdp" class="form-control" autocomplete="off" placeholder="Digite el número de CDP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputObjeto">Objeto: </label>
                        <div class="col-md-5">
                            <textarea rows="6" name="objeto" class="form-control" autocomplete="off" placeholder="Digite el objeto del contrato" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputDependencia">Depedencia: </label>
                        <div class="col-md-5">
                            <select class="form-control" name="dependencia" id="dependencia" required>
                                <option value="Rectoría">Rectoría</option>
                                <option value="Vicerrectoría de Docencia e Investigación">Vicerrectoría de Docencia e Investigación</option>
                                <option value="Vicerrectoría de Extensión">Vicerrectoría de Extensión</option>
                                <option value="Vicerrectoría Administrativa">Vicerrectoría Administrativa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputDateAprobacion">Fecha de Aprobación por comité: </label>
                        <div class="col-md-3">
                            <input type="date" name="date_aprobación" class="form-control" autocomplete="off" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputNameSupervisor">Nombre del Supervisor: </label>
                        <div class="col-md-5">
                            <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Digite el nombre del supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputIDSupervisor">Identificación del Supervisor: </label>
                        <div class="col-md-3">
                            <input type="text" name="id_supervisor" class="form-control" autocomplete="off" placeholder="Digite C.C. del supervisor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputEmailSupervisor">Email del Supervisor: </label>
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
        <h4><a class="btn btn-default" href="{{route('procesocontractual.index')}}">Volver a la lista de Procesos Contractuales</a></h4>
    </div>
@endsection