@extends('master')
@section('editprocesstype')
    <div class="container col-md-9">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Editar Tipo de Proceso de Contratación</h3></div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="/tipoproceso/{{$tipoproceso->id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Tipo de Proceso:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Tipo de Proceso:" value="{{ $tipoproceso->nombre }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputActivo">Determine el estado del Tipo de Proceso:</label>
                        <div class="col-md-4">
                            <div class="checkbox">
                                <label><input type="checkbox" {{ $tipoproceso->activo ? 'checked':''}} name="activo" value="1">Activo</label>
                            </div>
                        </div>
                    </div>
                    <form class="form-inline">
                        <div align="center">
                            <button type="submit" class="btn btn-default">Actualizar</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}">Volver a la lista de Tipos de Procesos</a></h4>
    </div>
@endsection