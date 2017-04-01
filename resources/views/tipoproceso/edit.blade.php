@extends('master')
@section('editprocesstype')
    <div class="container col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading"><h3>Editar Tipo de Proceso de Contratación</h3></div>
            <div class="panel-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form class="form-horizontal" method="post" action="/tipoproceso/{{$tipoproceso->id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputName">Nombre del Tipo de Proceso:</label>
                        <div class="col-md-4">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Tipo de Proceso:" value="{{ $tipoproceso->nombre }}" required>
                            <p style="font-size : 10px;">Nota: Tenga en cuenta que al actualizar el nombre del tipo de proceso,
                                también actualizará el nombre de la modalidad de los procesos asociados a este tipo de contratación.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="InputVersion">Versión:</label>
                        <div class="col-md-4">
                            <input type="text" name="version" class="form-control" placeholder="Nombre del Tipo de Proceso:" value="{{ $tipoproceso->version }}" required>
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
        <h4><a class="btn btn-default" href="{{route('tipoproceso.index')}}"><span class="glyphicon glyphicon-chevron-left"></span> Ir atrás</a></h4>
    </div>
@endsection