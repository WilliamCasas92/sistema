@extends('master')
@section('createprocesstype')
    <div class="container">
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
                                <label><input type="checkbox" name="activo" value="1">Activo</label>
                            </div>
                        </div>
                    </div><br>
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